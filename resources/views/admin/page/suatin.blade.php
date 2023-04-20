@extends('admin.layout.master')

@section('tieude')
{!! $data->TieuDe !!}
@endsection


@section('noidung')
<?php

use App\Models\CateModel;
?>
<div class="container-fluid">
    @if($errors->any())
    @foreach($errors->all() as $error)
    <div style="color: red;font-weight:bold;">{{ $error }}</div>
    @endforeach
    @endif
    @if(Session::has('up_news_success'))
    <div style="color: green;font-weight:bold;">{{ Session::get('up_news_success') }}</div>
    @endif
    @if(Session::has('trung_tieu_de'))
    <div style="color: red;font-weight:bold;">{{ Session::get('trung_tieu_de') }}</div>
    @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Chỉnh sửa bài viết "{!! $data->TieuDe !!}"</h1>


    <!-- DataTales Example -->
    <div class="row">

        <div class="col-lg-12 col-sm-12">
            <form action="/admin/cap-nhat-tin" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="info_cate_new_up" name="idtin" data-id="{{ $data->cateNews }}" value="{{ $data->newsId }}">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tiêu đề bài viết <span style="color:red;font-weight:bold;">(*)</span></label>
                    <input type="text" value="{!! $data->TieuDe !!}" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Chon thể loại cha<span style="color:red;font-weight:bold;">(*)</span></label>
                    <select id="category_parent_up" name="category_parent" class="custom-select">
                        <?php

                        $list_cate = CateModel::where("parent_ID", "=", 0)->where("parentS_ID", "=", 0)->where("date_deleCate", "=", null)->get();
                        // kierm tra chi tiết thể loại hiện tại
                        $check1 = CateModel::where("categoryId", "=", $data->cateNews)->where("date_deleCate", "=", null)->first();
                        $arr = [];
                        $stt = 0;
                        ?>
                        <?php foreach ($list_cate as $row) { ?>

                            <?php if ($row->categoryId == $data->cateNews) { ?>

                                <?php
                                $stt = 1;
                                $idC = $data->cateNews;
                                ?>
                                <option class="option_cate_up_news" selected value="<?= $row->categoryId ?>"><?= $row->nameCat ?></option>


                            <?php } elseif ($row->categoryId != $data->cateNews) { ?>


                                <?php if ($row->categoryId == $check1->parent_ID) { ?>
                                    <?php
                                    $stt = 2;
                                    $idS = $check1->parent_ID;
                                    ?>
                                    <option selected class="option_cate_up_news" value="<?= $row->categoryId ?>"><?= $row->nameCat ?></option>
                                <?php } else { ?>
                                    <option class="option_cate_up_news" value="<?= $row->categoryId ?>"><?= $row->nameCat ?></option>
                                <?php } ?>

                            <?php } ?>

                        <?php } ?>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Chon thể loại con </label>
                    <select id="category_son_up" name="category_son" class="custom-select">
                        <?php if ($stt == 1) { ?>


                            <option selected value="0">Chỉ lấy thể loại cha</option>
                            <?php
                            $qr = CateModel::where("parent_ID", "=", $idC)->where("date_deleCate", "=", null)->get();
                            ?>

                            <?php if (count($qr) > 0) { ?>
                                <?php foreach ($qr as $r) { ?>
                                    <option value="<?= $r->categoryId ?>"><?= $r->nameCat ?></option>
                                <?php } ?>
                            <?php } ?>



                        <?php } elseif ($stt == 2) { ?>

                            <option value="0">Chỉ lấy thể loại cha </option>
                            <?php
                            $qr2 = CateModel::where("parent_ID", "=", $idS)->where("date_deleCate", "=", null)->get();
                            ?>
                            <?php foreach ($qr2 as $r) { ?>
                                <?php if ($r->categoryId == $data->cateNews) { ?>
                                    <option selected value="<?= $r->categoryId ?>"><?= $r->nameCat ?> </option>
                                <?php } else { ?>
                                    <option value="<?= $r->categoryId ?>"><?= $r->nameCat ?> </option>
                                <?php } ?>
                            <?php } ?>

                        <?php } ?>



                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Từ khóa tìm kiếm</label>
                    <input type="text" data-role="tagsinput" value="{{ $data->Tag_News }}" name="tukhoa" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="input-group mb-3">
                    <img src="{{ asset('upload/img/tin') }}/{{ $data->imageNews }}" alt="" width="300px" height="200px">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Ảnh đại diện tin</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="file_avt_tin" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tóm tắt bài viết <span style="color:red;font-weight:bold;">(*)</span></label>
                    <textarea name="tomtat" id="tomtatbaiviet" cols="60" rows="10">{{ $data->TomTat }}</textarea>
                </div>
                <script>
                    CKEDITOR.replace('tomtatbaiviet')
                </script>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nội dung bài viết <span style="color:red;font-weight:bold;">(*)</span></label>
                    <textarea name="noidung" id="ndbaiviet" cols="60" rows="10">{{ $data->ContentNews }}</textarea>
                </div>
                <script>
                    CKEDITOR.replace('ndbaiviet')
                </script>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tác giả <span style="color:red;font-weight:bold;">(*)</span></label>
                    <input type="text" value="{{ $data->TacGia }}" name="tacgia" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Trạng thái</label>
                    </div>
                    <select class="custom-select" name="status" id="inputGroupSelect01">
                        @if($data->Show_Hide_News == 1)
                        <option selected value="1">Đang lưu hành</option>
                        <option value="2">Bị ẩn</option>
                        @elseif($data->Show_Hide_News == 2)
                        <option value="1">Đang lưu hành</option>
                        <option selected value="2">Bị ẩn</option>
                        @endif
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Ngày thêm</span>
                    </div>
                    <input disabled type="text" value="{{ $data->date_created }}  ( {{ $time_create_ago }} )" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Ngày cập nhật</span>
                    </div>
                    <?php if ($data->date_update != null && $time_update_ago != null) { ?>
                        <input disabled type="text" value="{{ $data->date_update }}  ( {{ $time_update_ago }} )" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                    <?php } elseif ($time_update_ago == null) { ?>
                        <input disabled type="text" value="Chưa cập nhật lần nào" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


    </div>

</div>

@endsection