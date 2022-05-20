<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FileUploadRequest;

class UploadController extends Controller
{
    public function upload(FileUploadRequest $request){
        
       
        try {
            
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $request->file('file')->storeAs('uploads', $fileName, 'public');
        
            return response()->json([
                "success" => true,
                "message" => "File has been uploaded.",
             ],200);
             
        } catch (\Throwable $th) {
            
            return response()->json([
                "success" => false,
                "message" => "File upload failed.",
                'errors' => [
                    'file' => "Oops! something went wrong."
                ]
             ],400);
        }
      
    
   }
}