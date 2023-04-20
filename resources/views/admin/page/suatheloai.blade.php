@extends('admin.layout.master')

@section('tieude')
Sửa thể loại {{ $data->nameCat }}
@endsection


@section('noidung')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sửa thể loại "{{ $data->nameCat }}"</h1>

    @if(Session::has('update_success'))
    <span style="color: green; font-weight:bold;">{{ Session::get('update_success') }}</span>
    @endif

    @if(Session::has('update_error'))
    <span style="color: red; font-weight:bold;">{{ Session::get('update_error') }}</span>
    @endif
    @if($errors->any())
    @foreach($errors->all() as $error)
    <span style="color: red; font-weight:bold;">{{ $error }}</span><br>0
    @endforeach
    @endif
    <!-- DataTales Example -->
    <div class="row">

        <div class="col-lg-12 col-sm-12">
            <form action="/admin/cap-nhat-the-loai/{{ $data->categoryId }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="hidden" id="idCateUp" parentid="{{ $data->parent_ID }}" name="idCate" value="{{ $data->categoryId }}">
                    <div style="color: red;font-weight:bold;" id="msg_ton_tai_danh_muc"></div>
                    <label for="name_cate_update" class="form-label">Tên danh mục <span style="color:red;font-weight:bold;">(*)</span></label>
                    <input type="text" class="form-control" value="{{ $data->nameCat }}" name="tentl" id="name_cate_update" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Thuộc thể loại <span style="color:red;font-weight:bold;">(*)</span></label>
                    <select name="category" class="custom-select">
                        <option <?php if($data->parent_ID == 0){ echo "selected";} ?> class="option_cate_parent" value="0">Thuộc thể loại cha</option>
                        @foreach($cate as $row)
                        @if($row->parent_ID == 0 && $row->parentS_ID == 0 && $row->date_deleCate == null)
                           @if($row->categoryId == $data->parent_ID)
                                 <option selected data-id="{{ $row->categoryId }}" value="{{ $row->categoryId }}">{{ $row->nameCat }}</option>
                           @elseif($row->categoryId == $data->categoryId)
                                 <option disabled data-id="{{ $row->categoryId }}" value="{{ $row->categoryId }}">{{ $row->nameCat }}</option>
                           @else
                                 <option data-id="{{ $row->categoryId }}" value="{{ $row->categoryId }}">{{ $row->nameCat }}</option>
                           @endif
                        @endif
                        @endforeach
                    </select>
                </div>
                <?php if ($data->statusCate == 1) { ?>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input checked type="radio" id="update_show_cate" name="show_hide" value="1" class="custom-control-input">
                        <label class="custom-control-label" for="update_show_cate">Hiện</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="update_hide_cate" name="show_hide" value="2" class="custom-control-input">
                        <label class="custom-control-label" for="update_hide_cate">Ẩn</label>
                    </div>
                <?php } elseif ($data->statusCate == 2) { ?>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="update_show_cate" name="show_hide" value="1" class="custom-control-input">
                        <label class="custom-control-label" for="update_show_cate">Hiện</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input checked type="radio" id="update_hide_cate" name="show_hide" value="2" class="custom-control-input">
                        <label class="custom-control-label" for="update_hide_cate">Ẩn</label>
                    </div>
                <?php } ?>
                            
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Biểu tượng đại diện </label>
                                             <?php if ($data->logoCate == null) { ?>
                                                    Không có logo
                                             <?php } elseif ((strpos($data->logoCate, '</i>')) == true) { ?>
                                                    <?= $data->logoCate ?>
                                             <?php  } else { ?>
                                                    <img src="{{ asset('upload/img/logo_cate') }}/<?= $data->logoCate ?>" alt="" width="50px" height="50px">
                                             <?php   } ?>
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

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Ngày thêm</span>
                    </div>
                    <input disabled type="text" value="{{ $data->date_addCate }}  ( {{ $time_add_ago }} )" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Ngày cập nhật</span>
                    </div>
                   <?php if($data->date_upCate != null && $time_update_ago != null){ ?>
                   <input disabled type="text" value="{{ $data->date_upCate }} ( {{ $time_update_ago }} )" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                   <?php }else{ ?>
                    <input disabled type="text" value="Chưa cập nhật lần nào" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                   <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary btnUpdateCategory">Submit</button>
            </form>
        </div>


    </div>

</div>

@endsection