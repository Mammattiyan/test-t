<?php

namespace App\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Modules\Profile\Models\Module_documents;
use Illuminate\Support\Facades\File;

class Core extends Controller {
    /*
     * 
     * function encodeIdAction
     * 
     * for encodeing id
     * param Id
     */

    public static function encodeIdAction($id) {
        return base64_encode($id . '#' . Carbon::now());
    }
    /*
     * 
     * function encodeIdAction
     * 
     * for encodeing id
     * param Id
     */

    public static function decodeIdAction($data) {
        return intval(explode("#",base64_decode($data))[0]);
    }
    
     /**
     * imageUnlinkAction
     * image Unlink 
     *
     * @return 
     * status
     */
    public static function imageUnlinkAction($moduleId) {
        if ($moduleId != '') {

            $documentName = Module_documents::select('document_name')->where('id', $moduleId)->first();
            $deleteImage = Module_documents::where('id', $moduleId)->delete();
            if ($deleteImage == 1) {
                $file = public_path() . "/uploads/users_gallery/" . $documentName->document_name;
                if (File::exists($file)) {
                    $status = File::delete($file);
                    if ($status) {
                        return ['status' => '1', 'msg' => 'file delete'];
                    } else {
                        return ['status' => '0', 'msg' => 'file not delete'];
                    }
                } else {
                    return ['status' => '0', 'msg' => 'file not exist'];
                }
            } else {
                return ['status' => '0', 'msg' => 'file not delete'];
            }
        }
    }
     /**
     * imageUnlinkAction
     * image Unlink 
     *
     * @return 
     * status
     */
    public static function videoUnlinkAction($moduleId) {
        if ($moduleId != '') {

            $documentName = Module_documents::select('document_name')->where('id', $moduleId)->first();
            $deleteImage = Module_documents::where('id', $moduleId)->delete();
            if ($deleteImage == 1) {
                $file = public_path() . "/uploads/users_videos/" . $documentName->document_name;
                if (File::exists($file)) {
                    $status = File::delete($file);
                    if ($status) {
                        return ['status' => '1', 'msg' => 'file delete'];
                    } else {
                        return ['status' => '0', 'msg' => 'file not delete'];
                    }
                } else {
                    return ['status' => '0', 'msg' => 'file not exist'];
                }
            } else {
                return ['status' => '0', 'msg' => 'file not delete'];
            }
        }
    }

}
