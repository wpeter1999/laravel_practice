<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MvimController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\BottomController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;

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

Route::get('/', function () {
    return view('home');
});
//越確定的路由放上面，越不確定或需要帶變數的放下面
Route::redirect('/admin', '/admin/title'); // redirect=重新導向
Route::prefix('admin')->group(function(){
    //get
    Route::get('/title',[TitleController::class,'index']);
    Route::get('/ad',[AdController::class,'index']);
    Route::get('/image',[ImageController::class,'index']);
    Route::get('/mvim',[MvimController::class,'index']);
    Route::get('/total',[TotalController::class,'index']);
    Route::get('/bottom',[BottomController::class,'index']);
    Route::get('/news',[NewsController::class,'index']);
    Route::get('/admin',[AdminController::class,'index']);
    Route::get('/menu',[MenuController::class,'index']);

    //post
    Route::post('/title',[TitleController::class,'store']);
    Route::post('/ad',[AdController::class,'store']);
    Route::post('/image',[ImageController::class,'store']);
    Route::post('/mvim',[MvimController::class,'store']);
    Route::post('/news',[NewsController::class,'store']);
    Route::post('/admin',[AdminController::class,'store']);
    Route::post('/menu',[MenuController::class,'store']);
    //update
    Route::patch('/title/{id}',[TitleController::class,'update']);

    //delete
    Route::delete('/title/{id}',[TitleController::class,'destroy']);

    //show
    Route::patch('/title/sh/{id}',[TitleController::class,'display']);


});

/*****不使用控制器的路由控制方式******* 

Route::get('/admin/{module}', function ($module) {
    switch ($module){
        case "title":
            return view('backend.module',['header' => '網站標題管理','module' => 'title']);
        break;
        case "ad":
            return view('backend.module',['header' => '動態廣告文字管理','module' => 'ad']);
        break;
        case "image":
            return view('backend.module',['header' => '校園映像圖片管理','module' => 'image']);
        break;
        case "mvim":
            return view('backend.module',['header' => '動畫管理','module' => 'mvim']);
        break;
        case "total":
            return view('backend.module',['header' => '進站人數管理','module' => 'total']);
        break;
        case "bottom":
            return view('backend.module',['header' => '頁尾版權管理','module' => 'bottom']);
        break;
        case "news":
            return view('backend.module',['header' => '最新消息管理','module' => 'news']);
        break;
        case "admin":
            return view('backend.module',['header' => '管理者管理','module' => 'admin']);
        break;
        case "menu":
            return view('backend.module',['header' => '選單管理','module' => 'menu']);
        break;
    }
});
*/

//modles

Route::get('/modals/addtitle',[TitleController::class,'create']);
Route::get('/modals/addad',[AdController::class,'create']);
Route::view('/modals/addimage', 'modals.base_modal',['modal_header' => '新增校園映像圖片']);

//edit
Route::get('/modals/title/{id}',[TitleController::class,'edit']);


/*
##群組路由##
Route::prefix('admin')->group(function(){
    Route::get('/', function () {
        return view('backend.title');
    });
    
    Route::get('/title', function () {
        return view('backend.title');
    });
    
    
    Route::get('/ad', function () {
        return view('backend.ad');
    });
});
##群組路由##
 */

