<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //index view
    function index() {
        return view('report');
    }
}
