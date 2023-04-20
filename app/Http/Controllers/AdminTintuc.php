<?php

namespace App\Http\Controllers;

use App\Models\CateModel;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AdminTintuc extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.page.home");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function trash()
    {
         $data = News::join("category", "category.categoryId", "=", "news.cateNews")->where("news.date_deleted","!=",null)->get();
         return view("admin.page.trashtin",['load'=>$data]);
    }



    public function list()
    {
        $list = News::join("category", "category.categoryId", "=", "news.cateNews")->where("news.date_deleted", "=", null)->get();
        return view("admin.page.dstin", ['list' => $list]);
    }


    public function create()
    {
        return view("admin.page.taotin");
    }

    public function create_post(Request $request)
    {
        $request->validate([
            "title" => "required",
            "category_parent" => "required",
            "file_avt_tin" => "required",
            "tomtat" => "required",
            "noidung" => "required",
            "tacgia" => "required",
        ], [
            "title.required" => "Vui lòng nhập tiêu đề !",
            "category_parent.required" => "Vui lòng chọn thể loại !",
            "file_avt_tin.required" => "Vui lòng chọn ảnh đại diện tin !",
            "tomtat.required" => "Vui lòng nhập tóm tắt !",
            "noidung.required" => "Vui lòng nhập nội dung !",
            "tacgia.required" => "Vui lòng nhập tác giả !",
        ]);

        $loi = array();
        $title = filter_var(trim($request->input("title")), FILTER_SANITIZE_STRING);
        $alias = $this->vn_str_filter($title);
        $alias = $this->formatUrl($alias, '-');
        $cate_parent = $request->input("category_parent");
        $tomtat = $request->input("tomtat");
        $noidung = $request->input("noidung");
        $tacgia = trim($request->input("tacgia"));
        $cate_son = $request->input("category_son");
        $tukhoa = trim($request->input("tukhoa"));

        $Arr_Tukhoa = explode(",",$tukhoa);
        $Arr_Slug_Tu_Khoa = [];
        for ($i=0; $i < count($Arr_Tukhoa) ; $i++) { 
              $Arr_Slug_Tu_Khoa[] = Str::slug($Arr_Tukhoa[$i]);
        }
        $Tag_News_slug = implode(",",$Arr_Slug_Tu_Khoa);

        if ($request->hasFile("file_avt_tin")) {
            $file = $request->file("file_avt_tin");
            $nameFile = $file->getClientOriginalName("file_avt_tin");
            $arrName = explode(".", $nameFile);
            $FileName = "TMP_NEWS_" . time() . "_" . $alias . "." . $arrName[1];
            $file->move("upload/img/tin", $FileName);
        }
        $check_title = News::where("TieuDe", "=", $title)->get();
        if (count($check_title) > 0) {
            $loi['trung_title'] = "Tiêu đề này đã tồn tại hãy chọn một tiêu đề khác !";
        }
        if (empty($loi)) {
            if ($cate_son == 0) {
                News::create([
                    "cateNews" => $cate_parent,
                    "TieuDe" => $title,
                    "imageNews" => $FileName,
                    "TomTat" => $tomtat,
                    "TacGia" => $tacgia,
                    "date_created" => now(),
                    "ContentNews" => $noidung,
                    'TieuDe_slug' => $alias,
                    "Tag_News"=>$tukhoa,
                    'Slug_Tags_News'=>$Tag_News_slug,
                ]);
            } else {
                News::create([
                    "cateNews" => $cate_son,
                    "TieuDe" => $title,
                    "imageNews" => $FileName,
                    "TomTat" => $tomtat,
                    "TacGia" => $tacgia,
                    "date_created" => now(),
                    "ContentNews" => $noidung,
                    'TieuDe_slug' => $alias,
                    "Tag_News"=>$tukhoa,
                    'Slug_Tags_News'=>$Tag_News_slug,
                ]);
            }
            return redirect(Url::previous())->with("create_news_success", " Thêm bài viết thành công !");
        } else {
            return redirect(Url::previous())->with("trung_tieu_de", $loi['trung_title']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function move_news_to_trash($id)
    {
          $move_trash = News::where("newsId","=",$id)->update([
             "date_deleted"=>now(),
          ]);
          if($move_trash){
                 return response()->json(['status'=>200]);
          }else{
                return response()->json(['status'=>202]);
          }
    }

    public function restore($id)
    {
       $restore_item = News::where("newsId","=",$id)->update([
            "date_deleted"=>null,
       ]);
       if($restore_item){
                   return response()->json(['status'=>200]);
         }else{
                   return response()->json(['status'=>202]);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $check_id = News::where("newsId", "=", $id)->get();
        if (count($check_id) > 0 && is_numeric($id)) {
            $data = News::where("newsId", "=", $id)->first();
            $time_create_ago = $this->facebook_time_ago($data->date_created);
            if($data->date_update != null){
                  $time_update_ago = $this->facebook_time_ago($data->date_update);
            }else{
                  $time_update_ago =null;
            }
            return view("admin.page.suatin", ['data' => $data,'time_create_ago'=>$time_create_ago,'time_update_ago'=>$time_update_ago]);
        } else {
            return redirect()->route("admin.not-found");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->isMethod("post")) {
            $idTin = $request->input("idtin");
            $data = News::where("newsId", "=", $idTin)->first();
            $request->validate([
                "title" => "required",
                "category_parent" => "required",
                "tomtat" => "required",
                "noidung" => "required",
                "tacgia" => "required",
            ], [
                "title.required" => "Vui lòng nhập tiêu đề !",
                "category_parent.required" => "Vui lòng chọn thể loại !",
                "tomtat.required" => "Vui lòng nhập tóm tắt !",
                "noidung.required" => "Vui lòng nhập nội dung !",
                "tacgia.required" => "Vui lòng nhập tác giả !",
            ]);
            $loi = array();
            $title = filter_var(trim($request->input("title")), FILTER_SANITIZE_STRING);
            $alias = $this->vn_str_filter($title);
            $alias = $this->formatUrl($alias, '-');
            $cate_parent = $request->input("category_parent");
            $tomtat = $request->input("tomtat");
            $noidung = $request->input("noidung");
            $tacgia = trim($request->input("tacgia"));
            $cate_son = $request->input("category_son");
            $tukhoa = trim($request->input("tukhoa"));
            $status = $request->input("status");
            $Arr_Tukhoa = explode(",",$tukhoa);
            $Arr_Slug_Tu_Khoa = [];
            for ($i=0; $i < count($Arr_Tukhoa) ; $i++) { 
                  $Arr_Slug_Tu_Khoa[] = Str::slug($Arr_Tukhoa[$i]);
            }
            $Tag_News_slug = implode(",",$Arr_Slug_Tu_Khoa);
            if ($title != $data->TieuDe) {
                $check_title = News::where("TieuDe", "=", $title)->where("TieuDe", "!=", $data->TieuDe)->get();
                if (count($check_title) > 0) {
                    $loi['trung_title'] = "Tiêu đề này đã có hãy chọn tiêu đề khác !";
                }
            }
            if (empty($loi)) {
                if ($request->hasFile('file_avt_tin')) {
                    $file = $request->file("file_avt_tin");
                    $nameFile = $file->getClientOriginalName("file_avt_tin");
                    $arrName = explode(".", $nameFile);
                    $FileName = "TMP_NEWS_" . time() . "_" . $alias . "." . $arrName[1];
                    $file->move("upload/img/tin", $FileName);
                    if ($cate_son == 0) {
                        News::where("newsId","=", $idTin)->update([
                            "cateNews" => $cate_parent,
                            "TieuDe" => $title,
                            "imageNews" => $FileName,
                            "TomTat" => $tomtat,
                            "TacGia" => $tacgia,
                            "date_update" => now(),
                            "ContentNews" => $noidung,
                            'TieuDe_slug' => $alias,
                            "Tag_News"=>$tukhoa,
                            'Slug_Tags_News'=>$Tag_News_slug,
                            'Show_Hide_News'=>$status,
                        ]);
                    } else {
                        News::where("newsId","=", $idTin)->update([
                            "cateNews" => $cate_son,
                            "TieuDe" => $title,
                            "imageNews" => $FileName,
                            "TomTat" => $tomtat,
                            "TacGia" => $tacgia,
                            "date_update" => now(),
                            "ContentNews" => $noidung,
                            'TieuDe_slug' => $alias,
                            "Tag_News"=>$tukhoa,
                            'Slug_Tags_News'=>$Tag_News_slug,
                            'Show_Hide_News'=>$status,
                        ]);
                    }
                } else {
                    if ($cate_son == 0) {
                        News::where("newsId","=", $idTin)->update([
                            "cateNews" => $cate_parent,
                            "TieuDe" => $title,
                            "TomTat" => $tomtat,
                            "TacGia" => $tacgia,
                            "date_update" => now(),
                            "ContentNews" => $noidung,
                            'TieuDe_slug' => $alias,
                            "Tag_News"=>$tukhoa,
                            'Slug_Tags_News'=>$Tag_News_slug,
                            'Show_Hide_News'=>$status,
                        ]);
                    } else {
                        News::where("newsId","=", $idTin)->update([
                            "cateNews" => $cate_son,
                            "TieuDe" => $title,
                            "TomTat" => $tomtat,
                            "TacGia" => $tacgia,
                            "date_update" => now(),
                            "ContentNews" => $noidung,
                            'TieuDe_slug' => $alias,
                            "Tag_News"=>$tukhoa,
                            'Slug_Tags_News'=>$Tag_News_slug,
                            'Show_Hide_News'=>$status,
                        ]);
                    }
                }
                return redirect(Url::previous())->with("up_news_success", " Cập nhật bài viết thành công !");
            } else {
                return redirect(Url::previous())->with("trung_tieu_de", $loi['trung_title']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remove = News::where("newsId","=",$id)->delete();

        if($remove){
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>202]);
        }
    }
}
