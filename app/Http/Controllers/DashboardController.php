<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Contact;
use App\Models\Template;
use App\Models\Campaign;

class DashboardController extends Controller
{
    protected $user_id;

    public function __construct() {
        $this->user_id = Cache::get('userId');
        // $this->user_id = 7;

        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');
    }

    //index view
    function index() {
        $contactsNum = Contact::join('groups', function ($join) {
            $join->on('contacts.group_id', '=', 'groups.id')
                  ->where('groups.user_id', $this->user_id);
        })->get()->count();
        $templatesNum = Template::where('user_id', $this->user_id)->get()->count();
        $campaignNum = Campaign::where('user_id', $this->user_id)->get()->count();


        return view('dashboard', compact('contactsNum', 'templatesNum', 'campaignNum')); 
    }
}
