@includeIf('inc.header')


<div class="container">
  <div class="row pt-4 pb-2">
    <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <!-- <div class="carousel-indicators"> -->
        <?php

        use App\Models\News;
        use App\Models\Comment;
        use Carbon\Carbon;

        $list = News::join("category", "category.categoryId", "=", "news.cateNews")
          ->where("news.date_deleted", "=", null)
          ->where("news.Show_Hide_News", "=", 1)
          ->orderBy('news.date_created', 'desc')
          ->limit(10)
          ->get();
        ?>

        <div class="carousel-inner">
          <?php foreach ($list as $key => $value) { ?>
            <?php if ($key == 0) { ?>
              <div style="background-image: url(<?php echo asset('upload/img/tin/' . $value->imageNews) ?>);background-size:cover;" data-alias="<?= $value->TieuDe_slug ?>" data-cate="<?= $value->aliasCat ?>" class="carousel-item box_slide_home_news active">
                <div class="content_news_slide_home">
                  <div class="h3 text-white"><?= $value->TieuDe ?></div>
                  <span class="badge bg-info">{{ $value->nameCat }}</span>
                  <p class="text-white"><?php
                                        $time = new Carbon($value->date_created);
                                        $time->setLocale("vi");
                                        echo $time->format('l jS \\of F Y h:i:s A');
                                        ?></p>
                </div>
              </div>
            <?php } else { ?>
              <div style="background-image: url(<?php echo asset('upload/img/tin/' . $value->imageNews) ?>);background-size:cover;" data-alias="<?= $value->TieuDe_slug ?>" data-cate="<?= $value->aliasCat ?>" class="carousel-item box_slide_home_news">
                <div class="content_news_slide_home">
                  <div class="h3 text-white"><?= $value->TieuDe ?></div>
                  <span class="badge bg-info">{{ $value->nameCat }}</span>
                  <p class="text-white"><?php
                                        $time = new Carbon($value->date_created);
                                        $time->setLocale("vi");
                                        echo $time->format('l jS \\of F Y h:i:s A');
                                        ?></p>
                </div>
              </div>
            <?php } ?>
          <?php } ?>


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
    <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
      <div class="row">
        <?php
        $tin_pl = News::join("category", "category.categoryId", "=", "news.cateNews")->where("news.date_deleted", "=", null)->where("news.Show_Hide_News", "=", 1)->where("news.cateNews", "=", 79)->orWhere("category.parent_ID", "=", 79)->take(10)->get();
        $Tin_tg_gt = News::join("category", "category.categoryId", "=", "news.cateNews")->where("news.date_deleted", "=", null)->where("news.Show_Hide_News", "=", 1)->where("news.cateNews", "=", 78)->orWhere("category.parent_ID", "=", 78)->take(10)->get();
        $Tin_the_gioi = News::join("category", "category.categoryId", "=", "news.cateNews")->where("category.date_deleCate", "=", null)->where("category.statusCate", "=", 1)->where("news.Show_Hide_News", "=", 1)->where("news.date_deleted", "=", null)->where("category.parent_ID", "=", 75)->orderBy("news.date_created", "desc")->take(10)->get();
        ?>
        <!-- slide trang chủ trên cùng bên phải  -->
        <div id="carouselExampleDark" class="carousel carousel-light slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            @foreach($tin_pl as $key => $row)
            @if($key == 0)
            <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" style="background-image: url(<?php echo asset('upload/img/tin/' . $row->imageNews) ?>);background-size:cover;" class="box_slide_up_right_news_hot_in_home carousel-item active">
              <div class="content_of_box_slide_up_right_news_hot_in_home">
                <div class="h5 text-white">{!! $row->TieuDe !!}</div>
                <span class="badge bg-info">{{ $row->nameCat }}</span>
              </div>
            </div>
            @else
            <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" style="background-image: url(<?php echo asset('upload/img/tin/' . $row->imageNews) ?>);background-size:cover;" class="box_slide_up_right_news_hot_in_home carousel-item">
              <div class="content_of_box_slide_up_right_news_hot_in_home">
                <div class="h5 text-white">{!! $row->TieuDe !!}</div>
                <span class="badge bg-info">{{ $row->nameCat }}</span>
              </div>
            </div>
            @endif
            @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <!-- Kết thúc slide -->
      </div>
      <div class="row">
        <div class="col-lg-5 col-sm-6">

          <!-- Slide trang chủ dưới bên trái  -->

          <div id="carouselExampleDark1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach($Tin_tg_gt as $key => $row)
              @if($key == 0)
              <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" style="background-image: url(<?php echo asset('upload/img/tin/' . $row->imageNews) ?>);background-size:cover;" class="box_slide_down_left_news_hot_in_home carousel-item active">
                <div class="content_of_box_slide_down_left_news_hot_in_home">
                  <div class="h6 text-white">{!! $row->TieuDe !!}</div>
                  <span class="badge bg-info">{{ $row->nameCat }}</span>
                </div>
              </div>
              @else
              <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" style="background-image: url(<?php echo asset('upload/img/tin/' . $row->imageNews) ?>);background-size:cover;" class="box_slide_down_left_news_hot_in_home carousel-item">
                <div class="content_of_box_slide_down_left_news_hot_in_home">
                  <div class="h6 text-white">{!! $row->TieuDe !!}</div>
                  <span class="badge bg-info">{{ $row->nameCat }}</span>
                </div>
              </div>
              @endif
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark1" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark1" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

        <!-- Kết thúc slide -->

        </div>
        <div class="col-lg-7 col-sm-6">
          <!-- Slide trang chủ dưới bên phải -->
          <div id="carouselExampleDark2" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach($Tin_the_gioi as $key => $row)
              @if($key == 0)
              <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" style="background-image: url(<?php echo asset('upload/img/tin/' . $row->imageNews) ?>);background-size:cover;" class="box_slide_down_right_news_hot_in_home carousel-item active">
                <div class="content_of_box_slide_down_right_news_hot_in_home">
                  <div class="h6 text-white">{!! $row->TieuDe !!}</div>
                  <span class="badge bg-info">{{ $row->nameCat }}</span>
                </div>
              </div>
              @else
              <div data-cate="{{ $row->aliasCat }}" data-news="{{ $row->TieuDe_slug }}" style="background-image: url(<?php echo asset('upload/img/tin/' . $row->imageNews) ?>);background-size:cover;" class="box_slide_down_right_news_hot_in_home carousel-item">
                <div class="content_of_box_slide_down_right_news_hot_in_home">
                  <div class="h6 text-white">{!! $row->TieuDe !!}</div>
                  <span class="badge bg-info">{{ $row->nameCat }}</span>
                </div>
              </div>
              @endif
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark2" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark2" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <!-- Kết thúc slide -->
        </div>
      </div>
    </div>
  </div>
  <div class="row pb-4">
    <div class="col-lg-12">
      <img src="https://www.plerdy.com/wp-content/uploads/2020/01/20.gif" alt="" width="100%" height="100%">
    </div>
  </div>
  <div class="row pb-3">

    @yield('noidung')


  </div>
  <div class="row pb-4">
    <div class="col-lg-12">
      <img src="https://www.plerdy.com/wp-content/uploads/2020/01/6.jpg" alt="" width="100%" height="100%">
    </div>
  </div>
</div>
@includeIf('inc.footer')