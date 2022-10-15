<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Campaign;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Template;
use Mail;

class CampaignController extends Controller
{
    protected $user_id;

    public function __construct() {
        $this->user_id = Cache::get('userId');
        // $this->user_id = 7;
    }
    
    //index view
    function index() {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');
        
        $data = Campaign::where('user_id', $this->user_id)->orderBy('created_at', 'desc')->paginate(env('itemsperpage'));
        return view('campaign.index', compact('data'));
    }

    function create() {
        return view('campaign.create');
    }

    function store(Request $request) {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        $campaigin = Campaign::create([
            'user_id' => $this->user_id,
            'name' => $request->name,
        ]);

        return redirect()->route('campaign.edit', $campaigin->id);
    }

    public function edit(Request $request, $id) {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        // If the campaign is not assigned to current user, throw exception
        $result = Campaign::where('user_id', $this->user_id)->where('id', $id)->first();
        if(!$result)
            return view('forbidden');

        $groups = Group::where('user_id', $this->user_id)->get();
        foreach($groups as $row) {
            $row['count'] = Contact::where('group_id', $row->id)->get()->count();
        }
        // Else go to edit page
        $campaign = Campaign::where('id', $id)->first();
        $initialGroupList = json_decode($campaign->receiver_emails);
        // var_dump($initialGroupList);

        return view('campaign.edit', compact('campaign', 'groups', 'initialGroupList'));
    }

    public function update(Request $request) {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        $edit_campaign = [
            'user_id' => $this->user_id,
            'name' => $request->name,
            'from_email' => $request->from_email,
            'from_name' => $request->from_name,
            'reply_to' => $request->reply_to,
            'name_to' => $request->name_to,
            'receiver_emails' => $request->receiver_emails,
            'subject_line' => $request->subject_line,
            'preview_text' => $request->preview_text,
            // 'template_id' => $request->template_id,
            'active_google_analytics' => $request->active_google_analytics == "on" ? 1 : 0,
            'embed_images' => $request->embed_images == "on" ? 1 : 0,
            'add_tag' => $request->add_tag == "on" ? 1 : 0,
            'add_attachment' => $request->add_attachment == "on" ? 1 : 0,
            'custom_unsubscribe' => $request->custom_unsubscribe == "on" ? 1 : 0,
            'update_profile_form' => $request->update_profile_form == "on" ? 1 : 0,
            'enable_mirror' => $request->enable_mirror == "on" ? 1 : 0,
        ];
        Campaign::where('id', $request->id)->update($edit_campaign);
        $mylist = Template::where('user_id', $this->user_id)->get();

        switch ($request->action) {
            case 'campaign': 
                return redirect()->route('campaign.index')->with('success', 'Your campaign is successfully updated.');
                break;
            case 'template':
                return view('templates.select', ['campaign_id' => $request->id, 'mylist' => $mylist]);
                break;
        }
    }

    public function usetemplate(Request $request) {
        $edit_campaign = [
            'template_id' => $request->template_id
        ];
        Campaign::where('id', $request->campaign_id)->update($edit_campaign);
        
        return redirect()->route('campaign.edit', $request->campaign_id)->with('success', 'The template is successfully selected.');
    }

    function delete(Request $request) {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        // If the campaign is not assigned to current user, throw exception
        $result = Campaign::where('user_id', $this->user_id)->where('id', $request->id)->first();
        if(!$result)
            return view('forbidden');

        Campaign::where('id', $request->id)->delete();
        return redirect()->route('campaign.index')->with('success', 'It is successfully removed.');
    }

    function duplicate(Request $request) {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        // If the campaign is not assigned to current user, throw exception
        $result = Campaign::where('user_id', $this->user_id)->where('id', $request->id)->first();
        if(!$result)
            return view('forbidden');

        $result = Campaign::where('id', $request->id)->first();
        
        unset($result->id);

        Campaign::create($result->toArray());
        return redirect()->route('campaign.index')->with('success', 'It is successfully duplicated.');
    }

    function sendtest(Request $request) {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        // If the campaign is not assigned to current user, throw exception
        $result = Campaign::where('user_id', $this->user_id)->where('id', $request->id)->first();
        if(!$result)
            return view('forbidden');

        $result = Campaign::where('id', $request->id)->first();
        $templateId = $result->template->template_id;
        $receiver_emails =  json_decode($result->receiver_emails);
        $group_list = array();
        foreach($receiver_emails as $group) {
            array_push($group_list, $group->id);
        }
        $contacts = Contact::whereIn('group_id', $group_list)->get();
        if(count($contacts) == 0) {
            return redirect()->route('campaign.index')->with('success', 'Your contact group is empty unable to send email.'); 
        }
        try{
            foreach($contacts as $contact)
            {
                $param = array();
                $address = $contact->email;
                $subject = $contact->subject_line;
                $from_email = $contact->from_email;
                $from_name = $contact->from_name;

                $result = Mail::send('emails.'. $templateId, $param, function ($message) use($address, $subject, $from_email, $from_name) {
                    $message->to($address, 'Hybridmail Techics')->subject($subject);
                    $message->from($from_email, $from_name);
                });
            }
        } catch (\Exception $e) {
            // Log error
            // Flag email for retry
            // continue;
         }
        
        return redirect()->route('campaign.index')->with('success', 'The email(s) are successfully sent.');

    }
}
