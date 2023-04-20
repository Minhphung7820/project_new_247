<?php

namespace App\Http\Controllers;

use App\Models\CateModel;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function loadcategory($id)
    {
          $output = "";
          $data = CateModel::where("parent_id","=",$id)->where("parentS_ID","=",0)->where("date_deleCate","=",null)->where("statusCate","=",1)->get();
          if(count($data) > 0){
            $output .= ' <div class="megasubmenu dropdown-menu">
            <div class="row">';
            foreach($data as $value){
                   $output .= ' 			
		                <div class="col-6">
		                    	<h6 class="title text-danger fw-bold"><i class="	fas fa-angle-double-right"></i> '.$value->nameCat.'</h6>
		                        <ul class="list-unstyled">';
		                        $cateParents = CateModel::where("parent_id","=",0)->where("parentS_ID","=",$value->categoryId)->get();
                                if(count($cateParents) > 0){
                                     foreach($cateParents as $vl){
                                        $output .= ' <li><a class="list-group-item list-group-item-action fw-bold" href="#">'.$vl->nameCat.'</a></li>';
                                     }
                                     $output .= ' <li><a class="list-group-item fw-bold text-info list-group-item-action" href="/tin-'.$vl->aliasCat.'"><i class="	fas fa-expand-arrows-alt"></i> Xem tất cả</a></li>';
                                }else{
                                    $output .= ' <li><a class="list-group-item fw-bold text-info list-group-item-action" href="/tin-'.$value->aliasCat.'"><i class="fas fa-expand-arrows-alt"></i> Xem tất cả</a></li>';
                                }
		                        $output .= ' </ul>
		                </div>';
            }
            $output .= '  </div>
            </div>';
            return response()->json(['status'=>200,"msg"=>$output]);
          }else{
            return response()->json(['status'=>202,"msg"=>null]);
          }
    }

    // public function load_category_in_create_cate($id)
    // {
    //       $check_danh_muc_cha = CateModel::where("categoryId","=",$id)->first();

    //       if($check_danh_muc_cha->parent_ID == 0 && $check_danh_muc_cha->parentS_ID == 0)
    //       {
    //             return response()->json(['status'=>1,"msg"=>"Thể loại cha"]);

    //       }elseif($check_danh_muc_cha->parent_ID != 0 && $check_danh_muc_cha->parentS_ID == 0)
    //       {
    //            $check_danh_muc_con = CateModel::where("categoryId","=",$check_danh_muc_cha->parent_ID)->first();

    //             return response()->json(['status'=>2,"msg"=>$check_danh_muc_con->nameCat]);
    //       }
    // }

    public function check_name_categories_create($key)
    {   
            $check = CateModel::where("nameCat","=",$key)->get();
            if(count($check) > 0){
                return response()->json(['status'=>200,"msg"=>"Tên thể loại này đã tồn tại !"]);
            }else{
               return response()->json(['status'=>202,"msg"=>null]);
            }
    }
    // public function check_idcate_up_news($id)
    // {
    //         $check = CateModel::where("categoryId","=",$id)->first();
    //         if($check->parent_ID == 0 && $check->parentS_ID == 0){
    //                 return response()->json(['status'=>200]);
    //         }elseif($check->parent_ID != 0 && $check->parentS_ID == 0){
    //                 return response()->json(['status'=>202,'msg'=>$check->parent_ID]);
    //         }
    // }
    public function load_category_son_create($id)
    {
        $output = "";
        $load = CateModel::where("parent_ID","=",$id)->where("parentS_ID","=",0)->where("date_deleCate","=",null)->get();
        $output .= ' <option value="0">Chỉ lấy danh mục cha</option>';
        foreach($load as $row)
        {
          $output .= ' <option value="'.$row->categoryId.'">'.$row->nameCat.'</option>';
        }
        return response()->json(['status'=>200,'msg'=>$output]);
    }

    public function load_category_up_create($id)
    {
        $output = "";
        $load = CateModel::where("parent_ID","=",$id)->where("parentS_ID","=",0)->where("date_deleCate","=",null)->get();
        $output .= ' <option  value="0">Chỉ lấy danh mục cha</option>';
        foreach($load as $row)
        {
          $output .= ' <option value="'.$row->categoryId.'">'.$row->nameCat.'</option>';
        }
        return response()->json(['status'=>200,'msg'=>$output]);
    }
    





}
