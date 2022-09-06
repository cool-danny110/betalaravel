<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Campaign;

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

        // Else go to edit page
        $campaign = Campaign::where('id', $id)->first();
        return view('campaign.edit', compact('campaign'));
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

        switch ($request->action) {
            case 'campaign': 
                return redirect()->route('campaign.index')->with('success', 'Your campaign is successfully updated.');
                break;
            case 'template':
                return view('templates.select', ['campaign_id' => $request->id]);
                break;
        }
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
}
