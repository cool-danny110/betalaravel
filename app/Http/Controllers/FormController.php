<?php

namespace App\Http\Controllers;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use File;

class FormController extends Controller
{
    protected $user_id;

    public function __construct() {
        $this->user_id = Cache::get('userId');
        $this->user_id = 7;
    }

    //index view
    function index() {
        $data = Form::where('user_id', $this->user_id)->orderBy('created_at', 'desc')->paginate(env('itemsperpage'));
        return view('forms.index', compact('data'));
    }

    function create() {
        return view('forms.create');
    }

    function edit(Request $request, $id) {
        if(!$this->user_id)
            return redirect()->to(env('base_url'). '/?page_id=394');

        $result = Form::where('user_id', $this->user_id)->where('id', $id)->first();
        if(!$result)
            return view('forbidden');

        $data = Form::where('id', $id)->first();
        return view('forms.edit', compact('data'));
    }
    
    function save(Request $request) {
        Form::create([
            'user_id' => $this->user_id,
            'path' => $request->filename,
            'name' => $request->name
        ]);
    }

    function update(Request $request) {
        Form::where('path', $request->filename)
            ->update([
                'name' => $request->name
            ]);
    }

    function delete(Request $request) {
        $file = __DIR__ . DIRECTORY_SEPARATOR. '../../../public/builders/'. $request->path. '.json';
        Form::where('id', $request->id)->delete();
        File::delete($file);
        
        $formFile = __DIR__ . DIRECTORY_SEPARATOR. '../../../public/forms/form_'. $request->path. '.php';
        File::delete($formFile);


        return redirect()->route('form.index')->with('success', 'The form is successfully removed');
    }

    function submit(Request $request) {
        var_dump($request->all());
        exit(0);
    }
}
