@extends('admin.layout.master')

@section('tieude')
Thêm tin mới
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
     @if(Session::has('create_news_success'))
           <div style="color: green;font-weight:bold;">{{ Session::get('create_news_success') }}</div>
     @endif
     @if(Session::has('trung_tieu_de'))
           <div style="color: red;font-weight:bold;">{{ Session::get('trung_tieu_de') }}</div>
     @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">+ Thêm bài viết mới</h1>


    <!-- DataTales Example -->
    <div class="row">

        <div class="col-lg-12 col-sm-12">
            <form action="{{ route('admin.them_tin_post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tiêu đề bài viết <span style="color:red;font-weight:bold;">(*)</span></label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Chon thể loại cha <span style="color:red;font-weight:bold;">(*)</span></label>
                    <select id="category_parent_create" name="category_parent" class="custom-select">
                        <option value="" selected>--Chọn thể loại cha--</option>
                         <?php
                         
                         $list_cate = CateModel::where("parent_ID","=",0)->where("parentS_ID","=",0)->where("date_deleCate","=",null)->get();
                         ?>
                         <?php foreach($list_cate as $row){ ?>
                                <option value="<?= $row->categoryId ?>"><?= $row->nameCat ?></option>
                         <?php } ?>
                         
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Chon thể loại con </label>
                    <select disabled id="category_son_create" name="category_son" class="custom-select">
                         <option class="opDefaultCate" value="" selected>--Chọn thể loại con--</option>
                         
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Từ khóa tìm kiếm</label>
                    <input data-role="tagsinput" type="text" value="" name="tukhoa" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                    <textarea name="tomtat" id="tomtatbaiviet" cols="60" rows="10"></textarea>
                </div>
                <script>
                    CKEDITOR.replace('tomtatbaiviet')
                </script>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nội dung bài viết <span style="color:red;font-weight:bold;">(*)</span></label>
                    <textarea name="noidung" id="ndbaiviet" cols="60" rows="10"></textarea>
                </div>
                <script>
                    CKEDITOR.replace('ndbaiviet')
                </script>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tác giả <span style="color:red;font-weight:bold;">(*)</span></label>
                    <input type="text" name="tacgia" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


    </div>

</div>

@endsection