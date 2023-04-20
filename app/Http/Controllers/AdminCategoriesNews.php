<?php

namespace App\Http\Controllers;

use App\Models\CateModel;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AdminCategoriesNews extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.page.dstheloai");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function trash()
    {
         $load_trash = CateModel::where("date_deleCate","!=",null)->get();
         return view("admin.page.trashcate",['load'=>$load_trash]);
    }

    public function create(Request $request)
    {
        $cate = CateModel::where("date_deleCate","=",null)->get();
        if($request->isMethod("post")){
            $request->validate([
                   "tentl"=>"required",
                   "category"=>"required"

            ],[
                "tentl.required"=>"Vui lòng nhập tên thể loại !",
                "category.required"=>"Vui lòng chọn một thể loại !",
            ]);
                  $name =filter_var(trim($request->input("tentl")),FILTER_SANITIZE_STRING);
                  $theloai  = $request->input("category");
                  if($request->hasFile("file_logo")){
                    $file = $request->file("file_logo");
                    $nameFile = $file->getClientOriginalName("file_logo");
                    $arrName = explode(".",$nameFile); 
                    $FileName = md5(time())."_".strtolower($arrName[0]).".".$arrName[1];
                    $file->move("upload/img/logo_cate",$FileName); 
                    $logo = $FileName;
                  }else{
                      $logo = trim($request->input("logo_code"));
                  }
                  $alias = $this->vn_str_filter($name);
                  $alias = $this->formatUrl($alias,'-');
                  if($theloai == 0){
                     CateModel::create([
                        "parent_ID"=>0,
                        "parentS_ID"=>0,
                        "nameCat"=>$name,
                        "aliasCat"=>$alias,
                        "logoCate"=>$logo,
                        "date_addCate"=>now(),
                        "statusCate"=>$request->input("show_hide")
                     ]);
                  }elseif($theloai != 0){
                    CateModel::create([
                        "parent_ID"=>$theloai,
                        "parentS_ID"=>0,
                        "nameCat"=>$name,
                        "aliasCat"=>$alias,
                        "logoCate"=>$logo,
                        "date_addCate"=>now(),
                        "statusCate"=>$request->input("show_hide")
                     ]);
                  }
                 return redirect(URL::previous())->with("create_success","Thêm danh mục thành công !");
        }
        return view("admin.page.taotheloai",['cate'=>$cate]);
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
    public function edit($id,Request $request)
    {
        $checkID = CateModel::where("categoryId","=",$id)->get();
        
        if(count($checkID) > 0  && is_numeric($id)){
            $loi = array();
            $cate = CateModel::all();
            $data = CateModel::where("categoryId","=",$id)->first();
            $time_add_ago = $this->facebook_time_ago($data->date_addCate);
            if($data->date_upCate != null){
               $time_update_ago = $this->facebook_time_ago($data->date_upCate);
            }else{
                $time_update_ago = null; 
            }
            if($request->isMethod("post")){
                   $name = filter_var(trim($request->input("tentl")),FILTER_SANITIZE_STRING);
                   $theloai = $request->input("category");
                   $check_cate_son = CateModel::where("parent_ID","=",$id)->get();
                    if($data->parent_ID == 0){
                        if($theloai != 0){
                            if(count($check_cate_son) > 0){
                                  $loi['loi'] = "Không thể đổi danh mục cha này thuộc danh mục khác , vì đang chứa danh mục con !";
                            }
                        }
                   }
                   if($name != $data->nameCat){
                        $checkName = CateModel::where("nameCat","=",$name)->where("nameCat","!=",$data->nameCat)->get();
                        if(count($checkName) > 0){
                            $loi['loi'] = "Tên thể loại này đã có hãy chọn tên khác !";
                        }
                    }


                          if(empty($loi)){
                                 $request->validate([
                                 "tentl"=>"required",                
                                   ],[
                                 "tentl.required"=>"Vui lòng nhập tên thể loại !",
                                 ]); 
                                 if($request->hasFile("file_logo")){
                                    $file = $request->file("file_logo");
                                    $nameFile = $file->getClientOriginalName("file_logo");
                                    $arrName = explode(".",$nameFile); 
                                    $FileName = md5(time())."_".strtolower($arrName[0]).".".$arrName[1];
                                    $file->move("upload/img/logo_cate",$FileName); 
                                    $logoFile = $FileName;
                                  }
                                      $logoHtml = trim($request->input("logo_code"));
                                 
                                  $alias = $this->vn_str_filter($name);
                                  $alias = $this->formatUrl($alias,'-');
                                     if($request->hasFile("file_logo") && $logoHtml == ""){
                                        if($theloai == 0){
                                            CateModel::where("categoryId","=",$id)->update([
                                               "parent_ID"=>0,
                                               "parentS_ID"=>0,
                                               "nameCat"=>$name,
                                               "aliasCat"=>$alias,
                                               "logoCate"=>$logoFile,
                                               "date_upCate"=>now(),
                                               "statusCate"=>$request->input("show_hide")
                                            ]);
                                         }elseif($theloai != 0){
                                            CateModel::where("categoryId","=",$id)->update([
                                               "parent_ID"=>$theloai,
                                               "parentS_ID"=>0,
                                               "nameCat"=>$name,
                                               "aliasCat"=>$alias,
                                               "logoCate"=>$logoFile,
                                               "date_upCate"=>now(),
                                               "statusCate"=>$request->input("show_hide")
                                            ]);
                                         }
                                     }elseif(!$request->hasFile("file_logo") && $logoHtml != ""){
                                        if($theloai == 0){
                                            CateModel::where("categoryId","=",$id)->update([
                                               "parent_ID"=>0,
                                               "parentS_ID"=>0,
                                               "nameCat"=>$name,
                                               "aliasCat"=>$alias,
                                               "logoCate"=>$logoHtml,
                                               "date_upCate"=>now(),
                                               "statusCate"=>$request->input("show_hide")
                                            ]);
                                         }elseif($theloai != 0){
                                            CateModel::where("categoryId","=",$id)->update([
                                               "parent_ID"=>$theloai,
                                               "parentS_ID"=>0,
                                               "nameCat"=>$name,
                                               "aliasCat"=>$alias,
                                               "logoCate"=>$logoHtml,
                                               "date_upCate"=>now(),
                                               "statusCate"=>$request->input("show_hide")
                                            ]);
                                         }
                                     }elseif(!$request->hasFile("file_logo") && $logoHtml == ""){
                                        if($theloai == 0){
                                            CateModel::where("categoryId","=",$id)->update([
                                               "parent_ID"=>0,
                                               "parentS_ID"=>0,
                                               "nameCat"=>$name,
                                               "aliasCat"=>$alias,
                                               "date_upCate"=>now(),
                                               "statusCate"=>$request->input("show_hide")
                                            ]);
                                         }elseif($theloai != 0){
                                            CateModel::where("categoryId","=",$id)->update([
                                               "parent_ID"=>$theloai,
                                               "parentS_ID"=>0,
                                               "nameCat"=>$name,
                                               "aliasCat"=>$alias,
                                               "date_upCate"=>now(),
                                               "statusCate"=>$request->input("show_hide")
                                            ]);
                                         }
                                     }
                                     return redirect()->route("admin.cap-nhat-the-loai",[$id])->with("update_success","Cập nhật thể loại thành công !");

                         } else{
                            return redirect()->route("admin.cap-nhat-the-loai",[$id])->with("update_error",$loi['loi']);
                         }
                   
            }
            return view("admin.page.suatheloai",["cate"=>$cate,"data"=>$data,'time_add_ago'=>$time_add_ago,'time_update_ago'=>$time_update_ago]);
        }else{
            return redirect()->route("admin.not-found");
        }
     
    }
    public function Category_notFound(){
             return view('admin.page.NotFound');
    }
    
    public function dashboard(){
         return view("admin.page.thongke");
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $check_parent = CateModel::where("parent_ID","=",$id)->get();

         if(count($check_parent) > 0){
                 return response()->json(['status'=>200]);
         }else{
                 $check_cate_in_news = News::where("cateNews","=",$id)->get();
                 if(count($check_cate_in_news) > 0){
                       return response()->json(['status'=>202]);
                 }else{
                    return response()->json(['status'=>204]);
                 }
         }
    }

    public function remove($id){
        CateModel::where('categoryId',"=",$id)->update([
            'date_deleCate'=>now(),
        ]);
      return response()->json(['status'=>200]);
    }

    public function restore($id)
    {
        CateModel::where('categoryId',"=",$id)->update([
            'date_deleCate'=>null,
        ]);
      return response()->json(['status'=>200]);
    }

    public function permanently_deleted($id)
    {
      $xoa_vinh_vien = CateModel::where("categoryId","=",$id)->delete();

      if($xoa_vinh_vien){
         return response()->json(['status'=>200]);
      }else{
        return response()->json(['status'=>202]);
      }
    }



}
