<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index()
  {
    $Tin_Xem_Nhieu = News::join("category", "category.categoryId", "=", "news.cateNews")->where("news.date_deleted", "=", null)->where("Show_Hide_News", "=", 1)->orderBy("news.Views_News", "desc")->take(4)->get();
    $Tin_Covid = News::join("category", "category.categoryId", "=", "news.cateNews")->where("category.date_deleCate", "=", null)->where("category.statusCate", "=", 1)->where("news.Show_Hide_News", "=", 1)->where("news.date_deleted", "=", null)->where("category.categoryId", "=", 112)->orderBy("news.date_created", "desc")->take(6)->get();
    $Tin_the_gioi = News::join("category", "category.categoryId", "=", "news.cateNews")->where("category.date_deleCate", "=", null)->where("category.statusCate", "=", 1)->where("news.Show_Hide_News", "=", 1)->where("news.date_deleted", "=", null)->where("category.parent_ID", "=", 75)->orderBy("news.date_created", "desc")->take(6)->get();
    $tin_Phap_luat =   News::join("category", "category.categoryId", "=", "news.cateNews")->where("news.date_deleted", "=", null)->where("news.Show_Hide_News", "=", 1)->where("news.cateNews", "=", 79)->orWhere("category.parent_ID", "=", 79)->take(4)->get();
    $TIn_Slide_The_Thao=   News::join("category", "category.categoryId", "=", "news.cateNews")->where("news.date_deleted", "=", null)->where("news.Show_Hide_News", "=", 1)->where("news.cateNews", "=", 72)->orWhere("category.parent_ID", "=", 72)->orderBy('news.date_created', 'desc')->take(10)->get();
    $Tin_giai_tri_the_gioi = News::join("category", "category.categoryId", "=", "news.cateNews")->where("news.date_deleted", "=", null)->where("news.Show_Hide_News", "=", 1)->where("news.cateNews", "=", 78)->orWhere("category.parent_ID", "=", 78)->take(8)->get();
    $arrTime_ago_Tin_covid = [];
    $arrTime_ago_Tin_the_gioi = [];
    $arrTime_ago_Tin_pl = [];
    $arrTimeAgo = [];
    $arrTimeAgo_tin_giai_tri = [];
    $arr_Time_Ago_tin_the_thao_slide = [];
    foreach ($Tin_Xem_Nhieu as $row) {
      $time_ago = $this->facebook_time_ago($row->date_created);
      $arrTimeAgo[] = [$row->newsId, $time_ago];
    }
    foreach ($Tin_Covid as $row) {
      $time_ago = $this->facebook_time_ago($row->date_created);
      $arrTime_ago_Tin_covid[] = [$row->newsId, $time_ago];
    }
    foreach ($Tin_the_gioi as $row) {
      $time_ago = $this->facebook_time_ago($row->date_created);
      $arrTime_ago_Tin_the_gioi[] = [$row->newsId, $time_ago];
    }
    foreach ($tin_Phap_luat as $row) {
      $time_ago = $this->facebook_time_ago($row->date_created);
      $arrTime_ago_Tin_pl[] = [$row->newsId, $time_ago];
    }
    foreach ($TIn_Slide_The_Thao as $row) {
      $time_ago = $this->facebook_time_ago($row->date_created);
      $arr_Time_Ago_tin_the_thao_slide[] = [$row->newsId, $time_ago];
    }
    $data = [
      "tin_xem_nhieu" => $Tin_Xem_Nhieu,
      "tin_covid" => $Tin_Covid,
      "tin_the_gioi" => $Tin_the_gioi,
      "tin_phap_luat" => $tin_Phap_luat,
      "tin_the_thao_slide"=>$TIn_Slide_The_Thao,
      "arr_timeAgo" => $arrTimeAgo,
      "arr_timeAgoPL" => $arrTime_ago_Tin_pl,
      "arr_timeAgo_The_Thao_slide"=>$arr_Time_Ago_tin_the_thao_slide,
      "tin_giai_tri_the_gioi"=>$Tin_giai_tri_the_gioi,
    ];
    return view('pages.home', $data);
  }

  public function test(Request $request)
  {
    $user = Auth::user();
    if ($request->hasFile("myFile")) {
      $file = $request->file("myFile");
      $nameFile = $file->getClientOriginalName("myFile");
      $arrName = explode(".", $nameFile);
      $FileName = md5(time()) . "_" . strtolower($arrName[0]) . "." . $arrName[1];
      $file->move("upload/img", $FileName);
      User::where("id", "=", $user->id)->update([
        "avatar" => $FileName,
      ]);
      return response()->json(['status' => 200, 'msg' => "Up ảnh thành công !"]);
    } else {
      return response()->json(['status' => 202, 'msg' => "Không có File !"]);
    }
  }
}
