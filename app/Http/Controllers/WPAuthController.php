<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wpuser;

use Illuminate\Support\Facades\Cache;
use DB;

class WPAuthController extends Controller
{
    protected $wp_user;

    /**
     *  Construct Controller to get model
     * 
     */
    public function __construct(Wpuser $wp_user) {
        $this->wp_user = $wp_user;
    }

    // WP Login Authentication 
    public function login(Request $request) {
        $username = $request->user;
        $email = $request->email;

        $wp_user = $this->wp_user->query()->where('user_login', $username)
                                           ->where('user_email', $email)->first();

        if($wp_user){

            Cache::forever('userId', $wp_user->ID);
            Cache::forever('userName', $wp_user->user_login);
            Cache::forever('userEmail', $wp_user->user_email);

            $memebership_level = DB::table('wp_ihc_user_levels')->where('user_id', $wp_user->ID)->first();

            if($memebership_level == NULL)
                Cache::forever('userLevel', 1);
            else {
                if($memebership_level->expire_time == '0000-00-00 00:00:00'){
                    Cache::forever('userLevel', 1);
                    Cache::forever('userPlan', $memebership_level->level_id);
                } else {
                    Cache::forever('userLevel', $memebership_level->level_id);
                }
            }

            return redirect()->route('dashboard');
        }
        else{
            return redirect()->to(env('base_url'). '/?page_id=395&ihc_login_fail=true');
        }
    }
}
