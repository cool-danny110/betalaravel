<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    //index view
    function index() {
        return view('form');
    }
}
