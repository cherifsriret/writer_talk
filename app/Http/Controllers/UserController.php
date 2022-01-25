<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function users(){
        $users = User::query()->orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function change_status($id = null, $status = null){
        $uuid = $id;
        $user_status = $status;
        $user = User::query()->where('uuid', $uuid)->update([
            'status'=>$user_status
        ]);
        return redirect()->back()->with('success','Status Changed Successfully');
}

    public function change_verify_status($id = null, $verify = null){
        $uuid = $id;
        $verify_user = $verify;
        $user = User::query()->where('uuid', $uuid)->update([
            'verify_user'=>$verify_user
        ]);
        return redirect()->back()->with('success','User Verification Status Changed Successfully');
    }

    public function user_posts($id = null){
        $uuid = $id;
//        $post_arr = [];
        $user = User::where('uuid',$uuid)->first();
        $posts = $user->posts()->get();
        $response = array(
          'success'=>true,
          'message'=> 'Record Found successfully',
          'posts'=>$posts
        );

        return view('users.post',compact('posts','user'));


    }

    public function remove_user_post($user = null, $post= null, $post_status = null){
        $user_id = $user;
        $post_id = $post;
        $status = $post_status;
        $post_suspend = Post::query()->where('user_id', $user_id)->where('uuid',$post_id)->first();
            $post_suspend->update([
           'suspend'=> $status
        ]);

        if ($post_suspend){
            $response = array(
               'success'=> true,
               'message'=> 'Post status changed successfully',
                'data'=>$post_suspend
            );
        }else{
            $response = array(
                'success'=> true,
                'message'=> 'Failed to change post status'
            );
        }

        return json_encode($response);

    }

}
