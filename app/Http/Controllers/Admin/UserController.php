<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penpal;
use App\Models\Post;
use App\Models\PromoCode;
use App\Models\QuickText;
use App\Models\User;
use App\Models\UserPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function users(){
        $users = User::query()->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
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
        $stories = $user->stories()->get();
        $penpal_count = Penpal::query()->where('status','accept')->where('sender_id', $user->uuid)
            ->orWhere('receiver_id',$user->uuid)
            ->count();

//        $response = array(
//            'success'=>true,
//            'message'=> 'Record Found successfully',
//            'posts'=>$posts
//        );
        return view('admin.users.post',compact('posts','user','stories' ,'penpal_count'));


    }

    public function user_penpals($id = null){
        $uuid = $id;
        $user = User::where('uuid',$uuid)->first();
        if (!$user){
            return redirect()->back();
        }else{
            $user_penpals = Penpal::query()->where('status','accept')->where('sender_id', $user->uuid)
                ->orWhere('receiver_id',$user->uuid)
                ->get();

            $to_pick = $user->uuid;
            $penpal_arr = [];
            if (sizeof($user_penpals)>0){
                foreach ($user_penpals as $u => $u_row){

                    if ($user->uuid == $u_row->sender_id){
                        $to_pick = $u_row->receiver_id;
                    }else{
                        $to_pick = $u_row->sender_id;

                    }

                    $penpal_data = User::query()->where('uuid', $to_pick)->first();
                    if ($penpal_data){
                        $penpal_data['formatted_created_at'] = $penpal_data->created_at->diffForHumans();
                        $u_row['penpal_details'] = $penpal_data;
                        array_push($penpal_arr,$u_row );
                    }

                }
            }
        }
        return view('admin.users.penpals', compact('penpal_arr','user'));
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

    public function get_user_transactions(){
        $user_payments = UserPayment::query()->whereIn('status', ['trial', 'accept'])
            ->orderBy('id','desc')->get();
        $total_payments = UserPayment::query()->where('status', 'accept')->sum('payment');
        $total_members = UserPayment::query()->where('status', 'accept')->count();
        $total_trial = UserPayment::query()->where('status', 'trial')->count();
        $total_expired = UserPayment::query()->whereIn('status', ['trial','accept'])
            ->where('end_date' ,'<', Carbon::now())->count();

        if (sizeof($user_payments)> 0){
            foreach ($user_payments as $u=> $row){
                $user = User::query()->where('uuid',$row->user_id)->first();
                $row['user'] = $user;
            }
        }
    return view('admin.users.transactions',compact('user_payments','total_payments','total_members','total_trial','total_expired'));
    }
    public function get_quick_text(){
        $quick_text = QuickText::all();
    return view('admin.users.quickText',compact('quick_text'));
    }

        public function get_user_promos(){
            $promo_codes = PromoCode::query()->orderBy('id', 'desc')->get();
            return view('admin.users.promos',compact('promo_codes'));
        }

        public function create_user_promo(Request $request){
           $add_promo = PromoCode::create([
                'promo_code'=>$request->input('promo_code'),
               'payment_option'=>$request->input('payment_option')

            ]);
           if ($add_promo){
               return redirect()->back();
           }
        }
        public function create_quick_text(Request $request){

        $if_present = QuickText::query()->first();
        if ($if_present){
            $update_data = [
                'text' => $request->input('quick_text')
            ];
            $add_quick_text = $if_present->update($update_data);
        }else{
            $add_quick_text = QuickText::create([
                'text'=>$request->input('quick_text'),
                'uuid'=>Str::uuid(),
            ]);
        }

           if ($add_quick_text){
               return redirect()->back();
           }
        }

        public function edit_user_promo($id = null){
            $promo_code = PromoCode::query()->where('id',$id)->first();
            if ($promo_code){
                $response = [
                    'success'=>true,
                    'message'=>'Record found successfully',
                    'data'=>$promo_code
                ];
            }
            return json_encode($response);
        }

        public function update_user_promo(Request $request){

        $id = $request->input('promo_code_id');
        $code =$request->input('promo_code');
            $update_code = PromoCode::where('id',$id)->update([
                'promo_code'=>$code,
                'payment_option'=>$request->input('payment_option')
            ]);
            return redirect()->back();
        }

        public function delete_user_promo($id = null){
        $delete_code = PromoCode::query()->where('id',$id)->delete();
        return redirect()->back();
        }

}
