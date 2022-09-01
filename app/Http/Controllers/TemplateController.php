<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\Cache;
use File;

class TemplateController extends Controller
{
    protected $user_id;

    public function __construct() {
        $this->user_id = Cache::get('userId');
    }

    // Template list view
    function index() {
        $mylist = Template::where('user_id', $this->user_id)->pluck('template_id')->toArray();
        return view('templates.index', compact('mylist'));
    }

    function select() {
        
    }

    function remove(Request $request) {
        $template_id = $request->template_id;
        $path = __DIR__ . DIRECTORY_SEPARATOR . "../../../public/templates/" . "user" . "/" . $template_id;
        File::deleteDirectory($path);
        Template::where('template_id', $template_id)->delete();
    }

    function design(Request $request) {
        $type = $request->type;
        $id = $request->id;
        return view('design.index', compact('id', 'type'));
    }

    function generateRandomString($length = 13) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function save(Request $request) {
        header('Content-Type: application/json');

        $templateID = $request->template_id;
        $type = $request->type;
        $newTemplateID = $this->generateRandomString();
       
        // Get the directory path of the specified template on the hosting server
        // Path may look like this: /storage/templates/{type}/{ID}/
        // In our sample templates, the HTML content is stored in the "index.html" file

        $org_path = __DIR__ . DIRECTORY_SEPARATOR . "../../../public/templates/" . $type . "/" . $templateID;
        $dist_path = __DIR__ . DIRECTORY_SEPARATOR . "../../../public/templates/" . "user" . "/" . $newTemplateID;

        if($type == "user") // If user clicked save and exit on currently customizing template, it might be stored in same url.
            $dist_path = $org_path;

        File::copyDirectory($org_path, $dist_path); // Copy Template Directory
        if($type != "user"){
            Template::create([      // Assign template to user and store it to db
                'user_id' => $this->user_id,
                'template_id' => $newTemplateID,
            ]);
        }
        
        // Get the HTML content submitted from BuilderJS (when user clicks SAVE)
        $html = $request->content;
        $newIndexPath = $dist_path. "/index.html";

        // Check if the file exists. Throw an error otherwise!
        if (!file_exists($newIndexPath)) {
            header("HTTP/1.1 404");
            echo json_encode([ 'message' => "File not found: $path" ]);
            return;
        }

        // Actually write the updated HTML content to the index.html file
        file_put_contents($newIndexPath, $html);

        // Return HTTP 200, SUCCESS
        header("HTTP/1.1 200");
        echo json_encode([ 'success' => "Written to file {$newIndexPath}" ]);
        return;
    }

    public function uploadAsset(Request $request) {
        // Get the Template ID posted to the server
        // Template ID and type are configured in your BuilderJS initialization code
        $templateID = $request->template_id;
        $type = $request->type;

        // Get the directory path of the specified template on the hosting server
        // Path may look like this: /storage/templates/{type}/{ID}/

        $path =  __DIR__ . DIRECTORY_SEPARATOR . "../../../public/templates/" . $type . "/" . $templateID . "/";

        if ($_POST['assetType'] == 'upload') {
            // Get uploaded file name
            $filename = $_FILES['file']['name'];
            
            // Escape sensitive characters in file name
            $filename = preg_replace('/[^a-z0-9\._\-]+/i', '_', $filename);

            // Storage path of the uploaded asset:
            // For example: /storage/templates/{type}/{ID}/Uploaded-Image.PNG
            $filepath = "{$path}/{$filename}";

            // Process uploaded file
            move_uploaded_file($_FILES['file']['tmp_name'], $filepath);
        } elseif ($_POST['assetType'] == 'url') {
            // upload file by upload image
            $filename = uniqid();

            // Storage path of the uploaded asset:
            // For example: /storage/templates/{type}/{ID}/604ce5e36d0fa
            $filepath = "{$path}/{$filename}";

            // Download the file's content
            $content = file_get_contents($_POST['url']);

            // Store it:
            file_put_contents($filepath, $content);
        } elseif ($_POST['assetType'] == 'base64') {
            // upload file by upload image
            $filename = uniqid();

            // Storage path of the uploaded asset:
            // For example: /storage/templates/{type}/{ID}/604ce5e36d0fa
            $filepath = "{$path}/{$filename}";

            // Store it
            file_put_contents($filepath, file_get_contents($_POST['url_base64']));
        }

        // Return the relative URL of the asset
        // Set up HTTP header for response
        header('Content-Type: application/json');
        header("HTTP/1.1 200");
        echo json_encode([ 'url' => $filename ]);

    }
}
