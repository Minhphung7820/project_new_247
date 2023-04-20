@extends('layout.master4')


@section('tieude')
{{ $name_cate }}
@endsection


@section('noidung')
<?php

use Carbon\Carbon;
?>
<div class="row">
    <div class="row">
        <div class="col-lg-12 col-sm-12 mb-4">
            <a style="color: black;	text-decoration: none;" href="/">Trang chủ</a> / <?php if($breadcrumb_cate_son != null){ echo '<a style="color: black;	text-decoration: none;" href="/tin-'.$breadcrumb_cate_son[0].'">'.$breadcrumb_cate_son[1].'</a> /'; } ?> <a style="color: black;	text-decoration: none;" href="tin-{{ $alias_cate }}">{{ $name_cate }}</a>
        </div>
        <div class="h4 box_title_namecate_news_hot_in_category_page col-lg-12">
            {{ $name_cate }}
        </div>
        @if($list_cate_son != null && count($list_cate_son) > 0)
        <div class="col-lg-12 slide_category_custom_img">
            @foreach($list_cate_son as $row)
            <div data-slug="{{ $row->aliasCat }}" class="card border-0 box_ele_slide_category_news">
                @if($row->logoCate != null)
                <img style="border-radius: 50%;" src="{{ asset('upload/img/logo_cate') }}/{{ $row->logoCate }}" class="card-img-top" alt="..." width="40px" height="90px">
                @else
                <img style="border-radius: 50%;" src="{{ asset('upload/img/logo_cate/no_icon2.png') }}" class="card-img-top" alt="..." width="40px" height="90px">
                @endif
                <div class="card-body text-center">
                    <h6>{{ $row->nameCat }}</h6>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-primary btn_prev_slide_category"><i class="	fas fa-arrow-circle-left"></i></button>
            <button type="button" class="btn btn-primary btn_next_slide_category"><i class="	fas fa-arrow-circle-right"></i></button>
        </div>
        @endif
        <div class="col-lg-12 mt-4">
            @foreach($list_tin as $row)
            <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" class="row mb-4 box_el_detail_news_where_category">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <img src="{{ asset('upload/img/tin') }}/{{ $row->imageNews }}" class="img-thumbnail" alt="...">
                </div>
                <div class="col-lg-9 col-sm-6 col-xs-12">
                    <div class="h5">{!! $row->TieuDe !!}</div>
                    <div class="fw-bold">
                        {{$row->nameCat}} , 
                        <?php
                        $time = new Carbon($row->date_created);
                        $time->setLocale("vi");
                        echo $time->format('l jS \\of F Y h:i:s A');
                        ?>
                    </div>
                    <div>{!! $row->TomTat !!}</div>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
    <div class="col-lg-12 mt-4">
        <div class="pagination_category">
            {{$list_tin->links()}}
        </div>
    </div>

    <div class="col-lg-12 mb-4">
      <img src="https://www.plerdy.com/wp-content/uploads/2020/01/41.jpg" alt="" width="100%" height="100%">
    </div>

</div>

@endsection