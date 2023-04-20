@extends('layout.master6')

@section('tieude')
{!! $data->TieuDe !!}
@endsection


@section('noidung')
<?php

use Carbon\Carbon;
?>
<div class="row">
    <div class="row">
        <div class="col-lg-12 col-sm-12 mb-4">
            <a style="color: black;	text-decoration: none;" href="/">Trang chủ</a> / <a style="color: black;	text-decoration: none;" href="/tin-{{ $data->aliasCat }}">{{ $data->nameCat }}</a> / <span>{!! $data->TieuDe !!}</span>
        </div>
        <div class="col-lg-12 col-sm-12 mb-4">
            <p><strong style="color: orange;font-weight:bold;">{!! $data->TacGia !!}</strong> , <i class="far fa-clock"></i> <?php
                                                                                                                                $time = new Carbon($data->date_created);
                                                                                                                                $time->setlocale("vi");
                                                                                                                                echo $time->format('l jS \\of F Y h:i:s A');
                                                                                                                                ?></p>
        </div>
        <div class="col-lg-12 col-sm-12 mb-4">
            <h1>{!! $data->TieuDe !!}</h1>

            <br><br>

            <div class="ndtin">
                {!! $data->ContentNews !!}
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 mb-4">
            Tags <i class="fas fa-tags"></i>&ensp;&ensp;
            <?php

            use App\Models\Comment;

            if ($data->Tag_News != null) {
                $tags = explode(",", $data->Tag_News);
            }
            ?>
            <?php if (!empty($tags)) { ?>
                <span class="tags">
                    <?php foreach ($tags as $key => $value) {  ?>
                        <!-- {{url('tag/'.\Str::slug($value))}} -->
                        <a class="tags_a" href="{{url('tag/'.\Str::slug($value))}}.html"><?= $value ?></a>
                    <?php } ?>
                </span>
            <?php } else { ?>
                Không có từ khóa
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="h4 title_news_related">
                 Tin liên quan
            </div>
        </div>
    </div>
    <div class="row">

    @if(count($related_news) > 0)
        <div class="col-lg-12">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($related_news as $key => $value)
                    @if($key == 0)
                    <div data-cate="{{ $value->aliasCat }}" data-news="{{ $value->TieuDe_slug }}" class="carousel-item box_slide_news_related_detail active">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <img class="img_detail_news_related" src="{{ asset('upload/img/tin') }}/{{ $value->imageNews }}" alt="" width="250px" height="200px">
                            </div>
                            <div class="col-lg-8 col-sm-12 col-xs-12">
                                <h4>{!! $value->TieuDe !!}</h4>
                                <p>{!! $value->TomTat !!}</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div data-cate="{{ $value->aliasCat }}" data-news="{{ $value->TieuDe_slug }}" class="carousel-item box_slide_news_related_detail">
                        <div class="row">
                            <div class="col-lg-4">
                                <img class="img_detail_news_related" src="{{ asset('upload/img/tin') }}/{{ $value->imageNews }}" alt="" width="250px" height="200px">
                            </div>
                            <div class="col-lg-8">
                                <h4>{!! $value->TieuDe !!}</h4>
                                <p>{!! $value->TomTat !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
       @else
        <div class="col-lg-12">
                  <h4>Không có tin liên quan</h4>
        </div>
       @endif
    </div>
    <div class="row">
        <div class="h4 title_comment_related">
           Bình luận (<?php echo count(Comment::where("idNews", "=", $data->newsId)->get()) ?> bình luận)
        </div>
    </div>
    <div class="row">
        <?php if (count($list_comment) > 0) { ?>
            <div class="col-lg-12 col-sm-12 mb-4 box_list_comment_detail_news p-4">
                <?php foreach ($list_comment as $row) { ?>
                    <div class="row box_cmt_row">
                        <div class="col-lg-1 col-sm-1 col-xs-1 pl-4">
                            <?php if ($row->provider_user_cmt == null) { ?>
                                <img width="50px" height="50px" style="border-radius:50% ;" src="<?php echo asset('upload/img/' . $row->avatar_cmt) ?>" alt="">
                            <?php } else { ?>
                                <img width="50px" height="50px" style="border-radius:50% ;" src="<?php echo $row->avatar_cmt ?>" alt="">
                            <?php } ?>
                        </div>
                        <div class="col-lg-11 col-sm-11 col-xs-11 pl-2">
                            <h6><?= $row->name_cmt ?> </h6>
                            <?php
                            if ($row->role_cmt == 2) {
                                echo '<div style="color:green;font-weight:bold;"><i class="fas fa-user-tie"></i> Quản trị viên</div>';
                            }
                            ?>
                            <?php foreach ($time_ago_cmt as $r) { ?>
                                <?php if ($row->commentId == $r[0]) { ?>
                                    <span style="color:#3399ff;font-weight:bold;"><?= $r[1] ?></span>
                                <?php } ?>
                            <?php } ?>
                            <p><?= $row->msg_cmt ?></p>
                            <span class="icon_like_comment"><i class="	fas fa-thumbs-up"></i></span> &ensp; &ensp;
                            <span class="icon_reply_comment"><i class="fas fa-reply"></i> </span>
                            <div class="form-floating form_reply_comment">
                                <form id="formReplyCmt">
                                    @csrf
                                    <p style="color:blue ;" id="name_user_reply_cmt">@<?= $row->name_cmt ?></p>
                                    <input type="hidden" name="iduser" value="<?= $row->userId ?>">
                                    <input type="hidden" name="idcmt" value="<?= $row->commentId ?>">
                                    <input type="hidden" name="idnews" value="{{ $data->newsId }}">
                                    <textarea class="form-control" name="reply_message" id="reply_message" style="height: 100px"></textarea>
                                    <button type="submit" class="btn btn-info text-white fw-bold btn_Reply_cmt"><i class="	fas fa-paper-plane"></i> Trả lời</button>
                                </form>
                            </div>

                        </div>

                    </div>
                    <?php
                    $load_cmt_reply = Comment::where("idNews", "=", $row->idNews)
                        ->where("status_cmt", "=", 1)
                        ->where("id_cmt_rep", "=", $row->commentId)
                        ->get();
                    ?>
                    <?php foreach ($load_cmt_reply as $r) { ?>
                        <div class="row box_reply_cmt_row">
                            <div class="col-lg-1 col-sm-1 col-xs-1 pl-0">
                                <?php if ($r->provider_user_cmt == null) { ?>
                                    <img width="50px" height="50px" style="border-radius:50% ;" src="<?php echo asset('upload/img/' . $r->avatar_cmt) ?>" alt="">
                                <?php } else { ?>
                                    <img width="50px" height="50px" style="border-radius:50% ;" src="<?php echo $r->avatar_cmt ?>" alt="">
                                <?php } ?>
                            </div>
                            <div class="col-lg-11 col-sm-11 col-xs-11 pl-4">
                                <?php if ($r->id_cmt_rep != null && $r->id_cmt_son_rep == null) { ?>
                                    <?php
                                    $detail_cmt = Comment::where("commentId", "=", $r->id_cmt_rep)->first();
                                    ?>
                                    <h6 class="text-info">Đã trả lời :@<?php echo $detail_cmt->name_cmt ?></h6>
                                    <!-- <p style="opacity:0.4;font-weight:bold;"><?= $detail_cmt->msg_cmt ?></p> -->
                                <?php } elseif ($r->id_cmt_rep != null && $r->id_cmt_son_rep != null) { ?>
                                    <?php
                                    $detail_cmt = Comment::where("commentId", "=", $r->id_cmt_son_rep)->first();
                                    ?>
                                    <h6 class="text-info">Đã trả lời :@<?php echo $detail_cmt->name_cmt ?></h6>
                                    <!-- <p style="opacity:0.4;font-weight:bold;"><?= $detail_cmt->msg_cmt ?></p> -->
                                <?php } ?>
                                <h6><?= $r->name_cmt ?> </h6>
                                <?php
                                if ($r->role_cmt == 2) {
                                    echo '<div style="color:green;font-weight:bold;"><i class="fas fa-user-tie"></i> Quản trị viên</div>';
                                }
                                ?>
                                <?php foreach ($arr_time_ago_rep_cmt as $value) { ?>
                                    <?php if ($value[0] == $r->commentId) { ?>
                                        <span style="color:#3399ff;font-weight:bold;"><?= $value[1] ?></span>
                                    <?php } ?>
                                <?php } ?>
                                <p><?= $r->msg_cmt ?></p>
                                <span class="icon_like_comment"><i class="	fas fa-thumbs-up"></i></span> &ensp; &ensp;
                                <span class="icon_reply_comment"><i class="fas fa-reply"></i> </span>
                                <div class="form-floating form_reply_comment">
                                    <form id="formReplyCmt">
                                        @csrf
                                        <p style="color:blue ;" id="name_user_reply_cmt">@<?= $r->name_cmt ?></p>
                                        <input type="hidden" name="iduser" value="<?= $r->userId ?>">
                                        <input type="hidden" name="idcmt" value="<?= $row->commentId ?>">
                                        <input type="hidden" name="id_son_cmt" value="<?= $r->commentId ?>">
                                        <input type="hidden" name="idnews" value="{{ $data->newsId }}">
                                        <textarea class="form-control" name="reply_message" id="reply_message" style="height: 100px"></textarea>
                                        <button type="submit" class="btn btn-info text-white fw-bold btn_Reply_cmt"><i class="	fas fa-paper-plane"></i> Trả lời</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="col-lg-12 col-sm-12 mb-4 p-4">
                <h4>Hãy là người bình luận đầu tiên !</h4>
            </div>
        <?php } ?>
        <div class="col-lg-12 col-sm-12 mb-4">
            <div class="form-floating">
                <form id="formcmtnews">
                    @csrf
                    <input type="hidden" name="idTin" value="{{ $data->newsId }}">
                    <textarea name="message" placeholder="Nhập bình luận vào đây..." class="form-control" id="box_message_comment" style="height: 150px"></textarea>
                    <br>
                    <button type="button" class="btn btn-info text-white fw-bold btncmtNews"><i class="	fas fa-paper-plane"></i> Gửi bình luận</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <img src="https://www.plerdy.com/wp-content/uploads/2020/01/41.jpg" alt="" width="100%" height="100%">
        </div>
    </div>
</div>
<!-- <p><iframe allowfullscreen scrolling="0" height="360" src="https://short.ink/RE6RIBemF" width="100%" frameborder="0"></iframe></p> -->
@endsection