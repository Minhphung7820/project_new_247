<?php

use App\Http\Controllers\AdminCategoriesNews;
use App\Http\Controllers\AdminTintuc;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TinController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
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

Route::get("/",[HomeController::class,"index"])->name('homePage');

Route::get("/tag/{tag}",[TinController::class,"tag"]);

Route::post("/Ajax/test",[HomeController::class,"test"])->name("testAjax");

Route::get("/Ajax/loadcategory/{id}",[AjaxController::class,"loadcategory"]);

Route::get("/tin-{alias}/{tieude}",[TinController::class,"chitiet"]);

Route::get("/page-not-found",[IndexController::class,"PageNotFound"]);

Route::get("/tin-{slug}",[TinController::class,"category"]);

Route::get("/Ajax/load-category-in-create-categrory/{id}",[AjaxController::class,"load_category_in_create_cate"]);

Route::post("/Ajax/check_name_cate_create/{key}",[AjaxController::class,"check_name_categories_create"]);

Route::post("/Ajax/check-category-before-remove/{id}",[AdminCategoriesNews::class,"destroy"]);

Route::post("/Ajax/remove-category/{id}",[AdminCategoriesNews::class,"remove"]);

Route::post("/Ajax/restore-category/{id}",[AdminCategoriesNews::class,"restore"]);

Route::post("/Ajax/xoa-vinh-vien-the-loai/{id}",[AdminCategoriesNews::class,"permanently_deleted"]);

Route::post("/Ajax/load-category-son-create-news/{id}",[AjaxController::class,"load_category_son_create"]);

Route::post("/Ajax/load-category-son-up-news/{id}",[AjaxController::class,"load_category_up_create"]);

Route::post("/Ajax/move-news-to-trash/{id}",[AdminTintuc::class,"move_news_to_trash"]);

Route::post("/Ajax/restore-news-in-trash/{id}",[AdminTintuc::class,"restore"]);

Route::post("/Ajax/delete-news-forever/{id}",[AdminTintuc::class,"destroy"]);

// Route::post("/Ajax/check-idcate-news-up/{id}",[AjaxController::class,"check_idcate_up_news"]);

Route::post("/comment-news",[TinController::class,"comment"])->name("post_cmt_news");

Route::post("/reply-comment",[TinController::class,"reply"]);

Route::middleware('delete_history')->group(function(){

    Route::get("/tai-khoan",[UserController::class,"index"])->name("getTai_khoan")->middleware('checklogin');

    Route::get("/dang-nhap",[UserController::class,"getLogin"])->name("getLogin")->middleware('register'); 

    Route::post("/dang-nhap",[UserController::class,"login"])->name("login-user"); 

    Route::post("/dang-xuat",[UserController::class,"logout"])->name("logout-custom");

    Route::get("/dang-xuat",[UserController::class,"getLogout"])->name("get_logout")->middleware("checklogin"); 

    Route::get("/facebook/redirect",[FacebookController::class,"FacebookRedirect"])->name('login-with-facebook'); 

    Route::get("/facebook/callback",[FacebookController::class,"FacebookCallback"])->middleware('fbcallback'); 

    Route::get("/google/redirect",[GoogleController::class,"GoogleRedirect"])->name('login-with-google'); 

    Route::get("/google/callback",[GoogleController::class,"GoogleCallback"])->middleware('ggcallback');  

    Route::get("/dang-ky",[UserController::class,"register"])->name('view-register')->middleware('register');

    Route::post("/dang-ky",[UserController::class,"postRegister"])->name('custom-register');

});
Route::prefix("admin")->name("admin.")->middleware("checklogin","admin")->group(function(){
    
      Route::get("/",[AdminTintuc::class,"index"]);

      Route::get("/thong-ke",[AdminCategoriesNews::class,"dashboard"])->name("get-thong-ke");

      Route::get("/thung-rac-the-loai",[AdminCategoriesNews::class,"trash"])->name("get-thung-rac");

      Route::get("/thung-rac-bai-viet",[AdminTintuc::class,"trash"])->name("thung-rac-tin");

      Route::get("/danh-sach-tin",[AdminTintuc::class,"list"])->name("ds_tin");

      Route::get("/them-tin",[AdminTintuc::class,"create"])->name("them_tin");

      Route::post("/them-tin",[AdminTintuc::class,"create_post"])->name("them_tin_post");

      Route::get("/danh-sach-the-loai",[AdminCategoriesNews::class,"index"])->name("ds_the_loai");

      Route::get("/them-the-loai",[AdminCategoriesNews::class,"create"])->name("tao_the_loai");

      Route::post("/them-the-loai",[AdminCategoriesNews::class,"create"])->name("post_them_the_loai");

      Route::get("/cap-nhat-the-loai/{id?}",[AdminCategoriesNews::class,"edit"])->name("cap-nhat-the-loai");

      Route::post("/cap-nhat-the-loai/{id?}",[AdminCategoriesNews::class,"edit"])->name("post-cap-nhat-the-loai");

      Route::get("/not-found",[AdminCategoriesNews::class,"Category_notFound"])->name("not-found");

      Route::get("/cap-nhat-tin/{id?}",[AdminTintuc::class,"edit"]);

      Route::post("/cap-nhat-tin",[AdminTintuc::class,"update"]);
      
});