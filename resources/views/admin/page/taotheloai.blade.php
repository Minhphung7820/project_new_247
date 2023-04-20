@extends('admin.layout.master')

@section('tieude')
Thêm thể loại mới
@endsection


@section('noidung')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">+ Thêm thể loại mới</h1>
    @if(Session::has('create_success'))
    <span style="color: green; font-weight:bold;">{{ Session::get("create_success") }}</span>
    @endif
    @if($errors->any())
    @foreach($errors->all() as $error)
    <span style="color: red; font-weight:bold;">{{ $error }}</span><br>
    @endforeach
    @endif

    <!-- DataTales Example -->
    <div class="row">

        <div class="col-lg-12 col-sm-12">
            <form action="{{ route('admin.post_them_the_loai') }}" method="POSt" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div style="color: red;font-weight:bold;" id="msg_ton_tai_danh_muc"></div>
                    <label for="name_cate_create" class="form-label">Tên danh mục <span style="color:red;font-weight:bold;">(*)</span></label>
                    <input type="text" class="form-control" name="tentl" id="name_cate_create" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Thuộc thể loại <span style="color:red;font-weight:bold;">(*)</span></label>
                    <select name="category" class="custom-select">
                        <option value="" selected>-- Chọn thể loại --</option>
                        <option value="0">Làm thể loại cha</option>
                        @foreach($cate as $row)
                        @if($row->parent_ID == 0 && $row->parentS_ID == 0)
                        <option data-id="{{ $row->categoryId }}" value="{{ $row->categoryId }}">{{ $row->nameCat }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input checked type="radio" id="update_show_cate" name="show_hide" value="1" class="custom-control-input">
                    <label class="custom-control-label" for="update_show_cate">Hiện</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="update_hide_cate" name="show_hide" value="2" class="custom-control-input">
                    <label class="custom-control-label" for="update_hide_cate">Ẩn</label>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Ảnh đại diện</label>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="	fas fa-file-upload"></i> Chọn File</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fab fa-html5"></i> Icon HTML</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Logo đại diện</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="file_logo" class="custom-file-input" id="file_logo_create_cate">
                                    <label class="custom-file-label" for="file_logo_create_cate">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-code"></i></span>
                                </div>
                                <input type="text" name="logo_code" id="logo_code_create_cate" class="form-control" placeholder="Nhập mã code vào đây" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btnAddCategory">Submit</button>
            </form>
        </div>


    </div>

</div>

@endsection