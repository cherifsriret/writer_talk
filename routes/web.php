<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', function () {
//    return view('welcome');
    return redirect('/admin/login');
});
Route::get('/', function () {
//    return view('welcome');
    return redirect('/admin/login');
});
//Route::get('login',function (){
//    return redirect('/admin/login');
//});
//Auth::routes(['register' => false,
//    'reset'=>false,
//    'remember'=> false]);


//Route::group(['middleware'=> 'auth'], function(){
Route::get('/accept-payment/{id}',[\App\Http\Controllers\PaymentController::class,'accept_payment']);
Route::get('/cancel-payment/{id}',[\App\Http\Controllers\PaymentController::class,'cancel_payment']);
Route::get('/payment-view',function (){
    return view('payment_response');
});

Route::get('/contact-us',function (){
    return view('users.contact_us');
});



Route::get('admin/login',[AuthController::class,'showLoginForm'])->name('admin.login');
Route::post('admin/login',[AuthController::class,'login']);
Route::prefix('/admin')->name('admin.')->namespace('Admin')->middleware('auth:admin')->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::get('/users',[App\Http\Controllers\Admin\UserController::class, 'users'])->name('users');
    Route::get('/change-status/{uuid}/{status}',[App\Http\Controllers\Admin\UserController::class, 'change_status'])->name('changeStatus');
    Route::get('/change-verify-status/{uuid}/{verify}',[App\Http\Controllers\Admin\UserController::class, 'change_verify_status'])->name('verifyUser');
    Route::get('/user-posts/{uuid}',[App\Http\Controllers\Admin\UserController::class, 'user_posts'])->name('userPosts');
    Route::get('/user-penpals/{uuid}',[App\Http\Controllers\Admin\UserController::class, 'user_penpals'])->name('userPenpals');
    Route::get('/remove-user-post/{user_id}/{post_id}/{post_status}',[App\Http\Controllers\Admin\UserController::class, 'remove_user_post'])->name('removeUserPost');

    Route::get('/upload-file', [\App\Http\Controllers\Admin\FileController::class, 'createForm'])->name('uploadFile');
    Route::post('/upload-file', [\App\Http\Controllers\Admin\FileController::class, 'fileUpload'])->name('submitUploadFile');
    Route::post('/update-admin-post-info', [\App\Http\Controllers\Admin\FileController::class, 'update_post_info'])->name('updatePostInfo');

    Route::get('/upload-tip', [\App\Http\Controllers\Admin\FileController::class, 'upload_tip'])->name('uploadTip');
    Route::post('/submit-tip', [\App\Http\Controllers\Admin\FileController::class, 'submit_tip'])->name('submitUploadTip');

    Route::get('/get-user-transactions', [\App\Http\Controllers\Admin\UserController::class, 'get_user_transactions'])->name('userTransactions');
    Route::get('/get-quick-text', [\App\Http\Controllers\Admin\UserController::class, 'get_quick_text'])->name('quickText');
    Route::get('/user-promo-codes', [\App\Http\Controllers\Admin\UserController::class, 'get_user_promos'])->name('userPromoCodes');
    Route::post('/create-promo-code', [\App\Http\Controllers\Admin\UserController::class, 'create_user_promo'])->name('createUserPromoCode');
    Route::post('/create-quick-text', [\App\Http\Controllers\Admin\UserController::class, 'create_quick_text'])->name('createQuickText');
    Route::get('/edit-promo/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit_user_promo'])->name('editUserPromoCode');
    Route::post('/update-promo', [\App\Http\Controllers\Admin\UserController::class, 'update_user_promo'])->name('updateUserPromoCode');
    Route::get('/delete-promo/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete_user_promo'])->name('deleteUserPromoCode');
    Route::get('/tags', [\App\Http\Controllers\Admin\FileController::class,'post_tags'])->name('postTags');
    Route::post('/submit-tag', [\App\Http\Controllers\Admin\FileController::class,'submit_post_tag'])->name('submitPostTag');
    Route::get('/delete-tag/{uuid}', [\App\Http\Controllers\Admin\FileController::class,'delete_post_tag'])->name('deletePostTag');
    Route::get('/delete-video/{id}', [App\Http\Controllers\Admin\FileController::class,'destroy_video'])->name('video.destory');
    Route::get('/delete-tip/{id}', [App\Http\Controllers\Admin\FileController::class,'destroy_tip'])->name('tip.destory');

});



