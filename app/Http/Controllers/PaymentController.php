<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function accept_payment($id = null){
        if ($id){
            $user_id = UserPayment::query()->where('uuid',$id)->pluck('user_id')->first();
            $update_status = UserPayment::query()->where('uuid',$id)->update([
                'status'=>'accept'
            ]);

           $update_promo_used = User::query()->where('uuid', $user_id)->first();
                $update_promo_used->promo_used = 0;

            if ($update_status && $update_promo_used->update()){
                return view('payment_response')->with(['success'=>true,'message'=>'Congargulations! Payment made Successfully. Now you can use Writers Talk App']);
            }else{
                return view('payment_response')->with(['success'=>false,'message'=>'message','Sorry! There is some problem in payment transfer. Try again later']);

            }
        }
    }

    public function cacnel_payment($id = null){
        if ($id){
            $update_status = UserPayment::query()->where('uuid',$id)->update([
                'status'=>'cancel'
            ]);
            if ($update_status){
                return view('payment_response')->with('message','Payment Cancelled');
            }
        }
    }
}
