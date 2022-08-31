<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;


class DashboardController extends Controller
{
    protected $user_id;

    public function __construct() {
        $this->user_id = Cache::get('userId');
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');
    }

    //index view
    function index() {
        return view('dashboard'); 
    }
}
