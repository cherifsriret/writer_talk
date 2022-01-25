<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    //
    public function createForm(){
        $user =  Auth::user();
        $videos = Video::query()->where('videoable_id', $user->uuid)
            ->where('videoable_type', 'Admin')->get();
        return view('admin.file_upload', compact('videos'));
    }

    public function fileUpload(Request $req){
        $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf,mp4|max:2048',
            'video_type' => 'required'
        ]);
        $type = $req->input('video_type');
        $fileModel = new Video;

        if($req->file()) {
            $fileName = time() . '_' . $req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads/videos', $fileName, 'public');
//            $fileModel->url = time().'_'.$req->file->getClientOriginalName();
            $fileModel->url =  $filePath;
        }
            $fileModel->uuid = Str::uuid();
            $fileModel->type = $type;

            $fileModel->videoable_id = Auth::user()->uuid;
            $fileModel->videoable_type = 'Admin';
            $fileModel->save();

            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);

    }

    public function destroy_video($id = null){

        $uuid = $id;
        $video = Video::where('uuid', $uuid)->first();

        if(Storage::exists('/public/'.$video->url)) {
            Storage::delete('/public/'.$video->url);
        }
        $video->delete();
        return response()->json([
            'success'=>true,
            'message' => 'Data deleted successfully!'
        ]);
    }
}
