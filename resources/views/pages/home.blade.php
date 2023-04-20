@extends('layout.master2')

@section('tieude')
Trang chủ
@endsection

@section('noidung')
<?php

use App\Models\Comment;
use App\Models\News;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
?>
<div class="col-lg-3 col-sm-12 mb-2">
    <div class="card">
        <div class="card-header bg-dark text-light fw-bold">
            Tình hình Covid-19
        </div>
        <div class="card-body p-0">
            <?php foreach ($tin_covid as $row) { ?>

                <div data-alias="<?= $row->TieuDe_slug ?>" data-cate="<?= $row->aliasCat ?>" class="box_slide_home_news box_news_home card mb-4">
                    <img src="{{ asset('upload/img/tin') }}/<?= $row->imageNews ?>" class="card-img-top bg-img-box-news" alt="...">
                    <div class="box_content_news">
                        <div class="card-body">
                            <h5 class="card-title text-white"><?= $row->TieuDe ?></h5>
                            <p class="card-text text-white"><?= $row->TacGia ?> , <?php
                                                                                    $time = new Carbon($row->date_created);
                                                                                    $time->setLocale("vi");
                                                                                    echo $time->format('l jS \\of F Y h:i:s A');
                                                                                    ?></p>
                            <p class="text-white fw-bold"><i class="fas fa-comment"></i>
                                <?php
                                $rc = Comment::where("idNews", "=", $row->newsId)->get();
                                echo count($rc);
                                ?> &ensp; &ensp; <i class="fas fa-eye"></i> <?= $row->Views_News ?> </p>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>
<div class="col-lg-6 col-sm-12 mb-2">
    <div class="card mb-4">
        <div class="card-header bg-dark text-light fw-bold">
            Tin xem nhiều
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($tin_xem_nhieu as $row) { ?>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <div class="card">
                            <img src="{{ asset('upload/img/tin') }}/<?= $row->imageNews ?>" class="card-img-top" alt="..." width="100%" height="180px">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row->TieuDe ?></h5>
                                <p class="card-text"><?php
                                                        $time = new Carbon($row->date_created);
                                                        $time->setLocale("vi");
                                                        echo $time->format('l jS \\of F Y h:i:s A');
                                                        ?>,
                                    <?php foreach ($arr_timeAgo as $r) { ?>
                                        <?php if ($r[0] == $row->newsId) { ?>
                                            <span style="color: black;font-weight:bold;"><?php echo $r[1] ?></span>
                                        <?php } ?>
                                    <?php } ?>
                                </p>
                                <p><i class="fas fa-comment"></i>
                                    <?php
                                    $rc = Comment::where("idNews", "=", $row->newsId)->get();
                                    echo count($rc);
                                    ?> &ensp; &ensp; <i class="fas fa-eye"></i> <?php echo Controller::DisplayViews($row->Views_News); ?> </p>
                                <p class="card-text"><?= $row->TomTat ?></p>
                                <a href="/tin-<?= $row->aliasCat ?>/<?= $row->TieuDe_slug ?>.html" class="btn btn-warning fw-bold">Đọc tin</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-12 mb-2">
    <div class="card">
        <div class="card-header bg-dark text-light fw-bold">
            Thế giới
        </div>
        <div class="card-body p-0">


            <?php foreach ($tin_the_gioi as $row) { ?>

                <div data-alias="<?= $row->TieuDe_slug ?>" data-cate="<?= $row->aliasCat ?>" class="box_slide_home_news box_news_home card mb-4">
                    <img src="{{ asset('upload/img/tin') }}/<?= $row->imageNews ?>" class="card-img-top bg-img-box-news" alt="...">
                    <div class="box_content_news">
                        <div class="card-body">
                            <h5 class="card-title text-white"><?= $row->TieuDe ?></h5>
                            <p class="card-text text-white"><?= $row->TacGia ?> , <?php
                                                                                    $time = new Carbon($row->date_created);
                                                                                    $time->setLocale("vi");
                                                                                    echo $time->format('l jS \\of F Y h:i:s A');
                                                                                    ?></p>
                            <p class="text-white fw-bold"><i class="fas fa-comment"></i>
                                <?php
                                $rc = Comment::where("idNews", "=", $row->newsId)->get();
                                echo count($rc);
                                ?> &ensp; &ensp; <i class="fas fa-eye"></i> <?= $row->Views_News ?> </p>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>
<div class="col-lg-12 pt-4 pb-4">
    <img src="https://www.plerdy.com/wp-content/uploads/2020/01/34.jpg" alt="" width="100%" height="100%">
</div>
<div class="col-lg-6 col-sm-12 mb-2">
    <div class="card mb-4">
        <div class="card-header bg-dark text-light fw-bold">
            Tin pháp luật
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($tin_phap_luat as $row) { ?>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <div class="card">
                            <img src="{{ asset('upload/img/tin') }}/<?= $row->imageNews ?>" class="card-img-top" alt="..." width="100%" height="180px">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row->TieuDe ?></h5>
                                <p class="card-text"><?php
                                                        $time = new Carbon($row->date_created);
                                                        $time->setLocale("vi");
                                                        echo $time->format('l jS \\of F Y h:i:s A');
                                                        ?>,
                                    <?php foreach ($arr_timeAgoPL as $r) { ?>
                                        <?php if ($r[0] == $row->newsId) { ?>
                                            <span style="color: black;font-weight:bold;"><?php echo $r[1] ?></span>
                                        <?php } ?>
                                    <?php } ?>
                                </p>
                                <p><i class="fas fa-comment"></i>
                                    <?php
                                    $rc = Comment::where("idNews", "=", $row->newsId)->get();
                                    echo count($rc);
                                    ?> &ensp; &ensp; <i class="fas fa-eye"></i> <?= $row->Views_News ?> </p>
                                <p class="card-text"><?= $row->TomTat ?></p>
                                <a href="/tin-<?= $row->aliasCat ?>/<?= $row->TieuDe_slug ?>.html" class="btn btn-warning fw-bold">Đọc tin</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 col-sm-12 mb-2">
    <div class="card">
        <div class="card-header  bg-dark text-light fw-bold">
            Nghệ thuật - Giải trí
        </div>
        <div class="card-body">

            @foreach($tin_giai_tri_the_gioi as $row)
            <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" class="row el_box_news_cate_giai_tri_home">
                <div class="col-lg-4 col-sm-12 col-xs-12">
                    <img class="img_news_home_giai_tri" src="{{ asset('upload/img/tin') }}/{{ $row->imageNews }}" alt="" width="200px" height="150px">
                </div>
                <div class="col-lg-8 col-sm-12 col-xs-12">
                    <div class="h5">{!! $row->TieuDe !!}</div>
                    <span class="badge bg-danger">{{ $row->nameCat }}</span>
                    <div class="fw-bold text-info">
                        <?php
                        Carbon::setLocale("vi");
                        $time = new Carbon($row->date_created);
                        echo $time->diffForHumans();
                        ?>
                    </div>
                    <div>
                    <i class="fas fa-comment-dots"></i>
                          <?php
                           $comment = News::find($row->newsId)->comment;
                           echo count($comment);
                          ?>
                           &ensp; &ensp; 
                     <i class="fas fa-eye"></i>
                     <?= $row->Views_News ?>                          
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</div>

<!-- @if(Session::has('upload_success'))
    <span style="color: green;font-weight:bold;">{{Session::get('upload_success')}}</span>
@endif -->

@endsection