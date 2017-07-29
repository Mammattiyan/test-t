<?php

namespace App\Modules\Videos\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\Profile\Models\Module_documents;
use Illuminate\Support\Facades\File;
use App\Libraries\VideoUploader;
use App\Modules\Core\Http\Controllers\Core;
use Illuminate\Support\Facades\Input;

class Videos extends Controller {
    /*
     * 
     * function indexAction
     * 
     * return message list view
     * param null
     */

    public function indexAction() {
        $userId = Auth::user()->id;
        $data = Module_documents::select('id', 'path')->where('parent_id', $userId)->where('module_name','user_videos')->get()->toArray();
        $appendedFiles = [];
        foreach ($data as $file) {
            if (file_exists(public_path() . '/' . $file['path'])) {
                $appendedFiles[] = array(
                    "name" => $file['path'],
                    "type" => VideoUploader::mime_content_type(public_path() . '/' . $file['path']),
                    "size" => filesize(public_path() . '/' . $file['path']),
                    "file" => asset('') . $file['path'],
                    "data" => array(
                        "url" => asset('') . $file['path'],
                        "id" => $file['id']
                    )
                );
            }
        }
        return view('videos::index')->with('images', $appendedFiles);
    }

    /*
     * @function imageUploadAction
     * 
     * image Upload  
     * 
     * param 
     * null
     * 
     * return 
     * html and array
     */

    public function videoUploadAction() {
        // initialize FileUploader
        $FileUploader = new VideoUploader('files', array(
            'uploadDir' => public_path() . "/uploads/users_videos/",
            'title' => 'auto',
        ));
        // call to upload the files
        $data = $FileUploader->upload();

        $userId = Auth::user()->id;
        $res = Module_documents::create(['parent_id' => $userId, 'module_name' => 'user_videos', 'document_name' => $data['files'][0]['name'], 'path' => $data['files'][0]['file'], 'orginal_name' => $data['files'][0]['old_name']]);
        echo $res->id;
        exit;
    }

    /*
     * @function imageRemove
     * 
     * remove photo from the plugin
     * 
     * param 
     * array
     * 
     * return 
     * Jsons
     */

    public function videoRemoveAction() {
        $moduleId = Input::get('id');
        $status = Core::videoUnlinkAction($moduleId);
        if ($status['status'] == 1) {
            return response()->json(['status' => '1', 'msg' => 'remove suceesfully']);
        } else {
            return response()->json(['status' => '0', 'msg' => 'remove not succefully']);
        }
    }

}
