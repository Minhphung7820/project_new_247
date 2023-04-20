<?php

namespace App\Http\Controllers;

use App\Models\CateModel;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


class TinController extends Controller
{
    public function tag($tag)
    {
        $arrTag = explode(".", $tag);
        $Tag_name = $arrTag[0];
        $tags = News::join("category", "category.categoryId", "=", "news.cateNews")
            ->where("news.Slug_Tags_News", "like", "%" . $arrTag[0] . "%")
            ->where("news.date_deleted", "=", null)
            ->where("news.Show_Hide_News", "=", 1)
            ->get();
        echo count($tags);
        return view("pages.tag")->with(compact('Tag_name'));
    }


    public function chitiet($cate, $title)
    {
        $arrAlias = explode(".", $title);
        $getDetail = News::join("category", "category.categoryId", "=", "news.cateNews")
            ->where("news.TieuDe_slug", "=", $arrAlias[0])
            ->first();
        if($getDetail){
            News::where("TieuDe_slug", "=", $arrAlias[0])->update([
                "Views_News" => $getDetail->Views_News + 1,
            ]);
            // Carbon::setlocale("vi");
            // $time = new Carbon($getDetail->date_created);
            // echo $time->diffForHumans();
            // echo count($getDetail->comment);
            // $dtcmt =Comment::where("commentId","=",125)->first();
            // echo $dtcmt->user->name;
            $load_comment = Comment::where("idNews", "=", $getDetail->newsId)
                ->where("status_cmt", "=", 1)
                ->where("user_rep", "=", null)
                ->where("id_cmt_rep", "=", null)
                ->get();
            $load_comment_reply = Comment::where("idNews", "=", $getDetail->newsId)
                ->where("status_cmt", "=", 1)
                ->where("user_rep", "!=", null)
                ->where("id_cmt_rep", "!=", null)
                ->get();
            $arr_time_ago_rep_cmt = [];
            $arr_cmt_time_ago = [];
            foreach ($load_comment as $r) {
                $timeAgo = $this->facebook_time_ago($r->date_cmt);
                $arr_cmt_time_ago[] = [$r->commentId, $timeAgo];
            }
            foreach ($load_comment_reply as $r) {
                $timeAgo = $this->facebook_time_ago($r->date_cmt);
                $arr_time_ago_rep_cmt[] = [$r->commentId, $timeAgo];
            }

            $related_news = News::join("category","category.categoryId","=","news.cateNews")
            ->where("news.Show_Hide_News","=",1)
            ->whereNotIn('news.newsId', [$getDetail->newsId])
            ->whereNull("news.date_deleted")
            ->Where("news.cateNews","=",$getDetail->cateNews)
            ->orWhere("category.parent_id","=",$getDetail->parent_ID) 
            ->orWhere("news.cateNews","=",$getDetail->parent_ID)  
            ->get();
            $data = [
                "data" => $getDetail,
                "list_comment" => $load_comment,
                "time_ago_cmt" => $arr_cmt_time_ago,
                'arr_time_ago_rep_cmt' => $arr_time_ago_rep_cmt,
                "related_news"=>$related_news,
            ];
            return view("pages.detail", $data);
        }else{
            return redirect("/page-not-found");
        }
    }
    public function comment(Request $request)
    {
        if ($request->isMethod("post")) {
            if (Auth::check()) {
                $idtin = $request->input("idTin");
                $message = filter_var(trim($request->input("message")), FILTER_SANITIZE_STRING);
                $iduser = Auth::user()->id;
                $avt = Auth::user()->avatar;
                $email = Auth::user()->email;
                $name = Auth::user()->name;
                $role = Auth::user()->role;
                if (Auth::user()->provider == null && Auth::user()->id_provider == null) {
                    $comment = Comment::create([
                        "userId" => $iduser,
                        "idNews" => $idtin,
                        "msg_cmt" => $message,
                        "date_cmt" => now(),
                        "avatar_cmt" => $avt,
                        "email_cmt" => $email,
                        "name_cmt" => $name,
                        "role_cmt" => $role
                    ]);
                } else {
                    $comment = Comment::create([
                        "userId" => $iduser,
                        "idNews" => $idtin,
                        "msg_cmt" => $message,
                        "date_cmt" => now(),
                        "avatar_cmt" => $avt,
                        "email_cmt" => $email,
                        "name_cmt" => $name,
                        "role_cmt" => $role,
                        "provider_user_cmt" => Auth::user()->id_provider,
                    ]);
                }

                if ($comment) {
                    return response()->json(['status' => 200]);
                } else {
                    return response()->json(['status' => 202]);
                }
            } else {
                return response()->json(['status' => 204]);
            }
        }
    }
    public function reply(Request $request)
    {
        if ($request->isMethod("post")) {
            if (Auth::check()) {
                $loi = array();
                $iduser_cmt = $request->input("iduser");
                $idcmt_reply = $request->input("idcmt");
                $idnews = $request->input("idnews");
                $message_reply = filter_var(trim($request->input("reply_message")), FILTER_SANITIZE_STRING);
                $iduser = Auth::user()->id;
                $avt = Auth::user()->avatar;
                $email = Auth::user()->email;
                $name = Auth::user()->name;
                $role = Auth::user()->role;
                if (empty($message_reply)) {
                    $loi['emty'] = "Trống ";
                }
                if (empty($loi)) {
                    if (Auth::user()->provider == null && Auth::user()->id_provider == null) {
                        $comment = Comment::create([
                            "userId" => $iduser,
                            "idNews" => $idnews,
                            "msg_cmt" => $message_reply,
                            "date_cmt" => now(),
                            "avatar_cmt" => $avt,
                            "email_cmt" => $email,
                            "name_cmt" => $name,
                            "role_cmt" => $role,
                            "user_rep" => $iduser_cmt,
                            "id_cmt_rep" => $idcmt_reply,
                            'id_cmt_son_rep' => $request->input("id_son_cmt"),
                        ]);
                    } else {
                        $comment = Comment::create([
                            "userId" => $iduser,
                            "idNews" => $idnews,
                            "msg_cmt" => $message_reply,
                            "date_cmt" => now(),
                            "avatar_cmt" => $avt,
                            "email_cmt" => $email,
                            "name_cmt" => $name,
                            "role_cmt" => $role,
                            "provider_user_cmt" => Auth::user()->id_provider,
                            "user_rep" => $iduser_cmt,
                            "id_cmt_rep" => $idcmt_reply,
                            'id_cmt_son_rep' => $request->input("id_son_cmt"),
                        ]);
                    }
                    if ($comment) {
                        return response()->json(['status' => 200]);
                    } else {
                        return response()->json(['status' => 202]);
                    }
                } else {
                    return response()->json(['status' => 206]);
                }
            } else {
                return response()->json(['status' => 204]);
            }
        }
    }

    public function category($slug)
    {

        $getDetail_cate = CateModel::Where("aliasCat", "=", $slug)->first();
        if ($getDetail_cate) {
            $name_cate = $getDetail_cate->nameCat;
            $alias_cate = $getDetail_cate->aliasCat;
            if ($getDetail_cate->parent_ID != 0) {
                $list_tin = News::join("category", "category.categoryId", "=", "news.cateNews")
                    ->where("news.Show_Hide_News", "=", 1)
                    ->where("news.date_deleted", "=", null)
                    ->where("category.categoryId", "=", $getDetail_cate->categoryId)
                    ->orWhere("news.cateNews", "=", $getDetail_cate->categoryId)
                    ->orWhere("category.parent_ID", "=", $getDetail_cate->categoryId)
                    ->orderBy("news.date_created", "desc")
                    ->paginate(9);
                $list_cate_son = null;
                $get_breadcrumb_cate_son = CateModel::where("categoryId", "=", $getDetail_cate->parent_ID)->first();
                $breadcrumb_cate_son = [$get_breadcrumb_cate_son->aliasCat,$get_breadcrumb_cate_son->nameCat];
            } elseif ($getDetail_cate->parent_ID == 0) {
                $get_cate_by_idparent = CateModel::where("parent_ID", "=", $getDetail_cate->categoryId)
                    ->where("date_deleCate", "=", null)
                    ->where("statusCate", "=", 1)
                    ->get();
                $list_cate_son = $get_cate_by_idparent;
                $list_tin = News::join("category", "category.categoryId", "=", "news.cateNews")
                    ->where("news.Show_Hide_News", "=", 1)
                    ->where("news.date_deleted", "=", null)
                    ->where("category.categoryId", "=", $getDetail_cate->categoryId)
                    ->orWhere("news.cateNews", "=", $getDetail_cate->categoryId)
                    ->orWhere("category.parent_ID", "=", $getDetail_cate->categoryId)
                    ->orderBy("news.date_created", "desc")
                    ->paginate(9);
                $breadcrumb_cate_son = null;
            }
            return view("pages.category")->with(compact("name_cate", "list_cate_son", "list_tin", "breadcrumb_cate_son","alias_cate"));
        } else {
            return redirect("/page-not-found");
        }
    }
}
