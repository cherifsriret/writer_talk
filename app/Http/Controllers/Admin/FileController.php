<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminPost;
use App\Models\AdminPostTag;
use App\Models\AdminTip;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    //
    public function createForm(){
        $user =  Auth::guard('admin')->user();
        $admin_posts =AdminPost::query()->where('user_id',$user->uuid)->get();
        $tags = Tag::query()->orderByDesc('id')->get();
        return view('admin.file_upload', compact('admin_posts','tags'));
    }

    public function fileUpload(Request $request){
        $request->validate([
            'file' => 'required|mimes:jpg,pdf,jpeg,gif,png,csv,txt,xlx,xls,pdf,mp4',
            'video_type' => 'required'
        ]);
        $type = $request->input('video_type');
        $extension = $request->input('file_extension');
        $tags = $request->input('post_tags');

        if($request->file()) {
            $fileName = Str::random(6).time() . '.' . $request->file->getClientOriginalExtension();

            $filePath = $request->file('file')->storeAs('uploads/videos/', $fileName, 'public');
//            $fileModel->url = time().'_'.$request->file->getClientOriginalName();
//            $fileModel->url =  $filePath;
        }

        $admin_post = AdminPost::create([
            'uuid'=>Str::uuid(),
            'user_id' => Auth::guard('admin')->user()->uuid,
            'tip_type'=> $request->video_type,
            'file'=> 'uploads/videos/'.$fileName,
            'file_type'=> $extension
        ]);
        if ($admin_post){
            if (sizeof($tags) > 0){
                foreach ($tags as $t=>$t_row){
                    $tag = Tag::query()->where('uuid', $t_row)->first();
                    if ($tag){
                      $admin_post_tag = AdminPostTag::create([
                           'uuid'=>Str::uuid(),
                           'post_id'=>$admin_post->uuid,
                           'tag_id'=>$tag->uuid
                       ]);

                    }
                }
            }
        }

        return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);

    }
    public function update_post_info(Request $request){
        $post_id = $request->input('post_id');
        $title = $request->input('title');
        $description = $request->input('description');
        $user_data = Auth::user();
        if($user_data){

        if($post_id){
            $update_data = array(
                'title' => $title,
                'description' => $description
            );
            $update_ip = AdminPost::query()
                ->where('uuid',$post_id)
                ->update($update_data);

            return back()
                ->with('success','Data has been updated.');
        }


        }else{
            return redirect('login');
        }

        return redirect()->back();
    }


    public function upload_tip(){
        $user =  Auth::guard('admin')->user();
        $admin_tips =AdminTip::query()->where('user_id',$user->uuid)->get();
        return view('admin.tip_upload', compact('admin_tips'));
    }

    public function submit_tip(Request $request){
        $request->validate([
            'file' => 'required|mimes:jpg,pdf,jpeg,gif,png,csv,txt,xlx,xls,pdf,mp4',
        ]);
        $extension = $request->input('file_extension');
        $tags = $request->input('post_tags');

        if($request->file()) {
            $fileName = Str::random(6).time() . '.' . $request->file->getClientOriginalExtension();

            $filePath = $request->file('file')->storeAs('uploads/videos/', $fileName, 'public');
//            $fileModel->url = time().'_'.$request->file->getClientOriginalName();
//            $fileModel->url =  $filePath;
        }

        $admin_post = AdminTip::create([
            'uuid'=>Str::uuid(),
            'user_id' => Auth::guard('admin')->user()->uuid,
            'file'=> 'uploads/videos/'.$fileName,
            'file_type'=> $extension
        ]);

        return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);

    }

    public function post_tags(){
        $tags = Tag::query()->orderByDesc('id')->get();
        return view('admin.tags',compact('tags'));
    }

    public function submit_post_tag(Request $request){
        $tag_name = $request->input('tag_name');
        $add_tag = Tag::create([
            'uuid'=>Str::uuid(),
            'tag_name'=>$tag_name
        ]);

        return redirect('/admin/tags')->with('success','Tag added Successfully.');

    }

    public function delete_post_tag($uuid = null){
        $tag = Tag::query()->where('uuid',$uuid)->first();
        if ($tag){
            $admin_post_tags = AdminPostTag::query()->where('tag_id', $tag->uuid)->delete();
            $tag->delete();
        }
        return redirect('/admin/tags')->with('success','Tag deleted Successfully.');
    }

    public function destroy_video($id = null){

        $uuid = $id;
        $admin_post = AdminPost::query()->where('uuid', $uuid)->first();

        if(Storage::exists('/public/'.$admin_post->file)) {
            Storage::delete('/public/'.$admin_post->file);
        }
        if ($admin_post){
            $post_tag = AdminPostTag::query()->where('post_id',$admin_post->uuid)->delete();
            $admin_post->delete();
        }
        return redirect()->back();
    }
    public function destroy_tip($id = null){
        $uuid = $id;
        $admin_post = AdminTip::query()->where('uuid', $uuid)->first();

        if(Storage::exists('/public/'.$admin_post->file)) {
            Storage::disk('local')->delete('/public/'.$admin_post->file);
        }
        $admin_post->delete();
        return redirect()->back();
    }
}
