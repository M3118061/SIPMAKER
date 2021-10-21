<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class FileUploadController extends Controller
{
    public function create() 
     
    {
        return view('fileuploadmasuk.create'); 
    } 
     
    public function store(Request $request)
    { 
        $request->validate(['file' => 'required|mimes:pdf|max:1024']);
 
        $file_name = time().'.'.$request->file->extension();  
 
        $request->file->move(public_path('file uploads masuk'), $file_name);
 
        return back()
            ->with('success','Successfully uploaded a file!')
            ->with('file',$file_name);
    }
}
