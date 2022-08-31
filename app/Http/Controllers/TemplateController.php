<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    //index view
    function index() {
        return view('templates.index');
    }

    function select() {
        
    }

    function design(Request $request) {
        $type = $request->type;
        $id = $request->id;
        return view('design.index', compact('id', 'type'));
    }
}
