<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminPost;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $data['total_users'] = User::query()->count();
        $data['active_users'] = User::query()->where('status', 'active')->count();
        $data['verify_users'] = User::query()->where('verify_user', 1)->count();
        $data['total_groups'] = Group::query()->count();
        $data['total_admin_tips'] = AdminPost::query()->count();
        $users = User::query()->orderBy('id','desc')->get();
        $data['users'] = $users;
        return view('admin.home', $data);
    }

}
