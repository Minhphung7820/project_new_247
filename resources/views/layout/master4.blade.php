@includeIf('inc.header')


<div class="container">
  <?php

  use App\Models\News;
  use App\Models\Comment;
  use Carbon\Carbon;

  $tin_moi_trong_ngay = News::join("category", "category.categoryId", "=", "news.cateNews")
    ->where("news.date_deleted", "=", null)
    ->where("news.Show_Hide_News", "=", 1)
    ->orderBy('news.date_created', 'desc')
    ->take(6)
    ->get();
  ?>
  <div class="row pt-4 pb-4">
    <div class="col-lg-8 col-sm-12 col-xs-12 mb-4">
      @yield('noidung')
    </div>
    <div class="mt-4 col-lg-4 col-sm-12 col-xs-12 mb-4">
      <div class="mt-4 h4 box_title_news_hot_in_category_page">
        Tin tức nổi bật trong ngày
      </div>
      <div class="row">
        <div class="col-lg-12">
      
        @foreach($tin_moi_trong_ngay as $key => $row)
           @if(count($tin_moi_trong_ngay) == $key + 1 )
           <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" class="row box_news_hot_in_side_right_master_4">
            <div class="col-lg-4">
              <img src="{{ asset('upload/img/tin') }}/{{ $row->imageNews }}" width="100%" height="100%" alt="">
            </div>
            <div class="col-lg-8">
              <div class="h5">
                {!! $row->TieuDe  !!}
              </div>
              <span class="badge bg-danger">{!! $row->nameCat !!}</span>
              <div class="fw-bold text-info">
               <?php
               Carbon::setLocale("vi");
               $time = new Carbon($row->date_created);
               echo $time->diffForHumans();
               ?>
              </div>
            </div>
          </div>
           @else
           <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" class="row box_news_hot_in_side_right_master_4">
            <div class="col-lg-4">
              <img src="{{ asset('upload/img/tin') }}/{{ $row->imageNews }}" width="100%" height="100%" alt="">
            </div>
            <div class="col-lg-8">
              <div class="h5">
                {!! $row->TieuDe  !!}
              </div>
              <span class="badge bg-danger">{!! $row->nameCat !!}</span>
              <div class="fw-bold text-info">
               <?php
               Carbon::setLocale("vi");
               $time = new Carbon($row->date_created);
               echo $time->diffForHumans();
               ?>
              </div>
            </div>
          </div>
          <hr>
           @endif
        @endforeach
          
        </div>
      </div>

      <div class="row pt-4">
        <div id="box_advenment_in_master_4_side_right" class="col-lg-12 text-center sticky_one">
            <img src="https://www.plerdy.com/wp-content/uploads/2020/01/81.jpg"  alt="">
        </div>
      </div>
    </div>
  </div>
</div>
@includeIf('inc.footer')