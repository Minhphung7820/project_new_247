@extends('admin.layout.master')

@section('tieude')
Quản trị danh mục tin
@endsection


@section('noidung')
<?php
    use App\Models\CateModel;
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tất cả thể loại</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.tao_the_loai') }}"><button type="button" class="btn btn-primary">+ Thêm thể loại mới</button></a>
            <a href="{{ route('admin.get-thung-rac') }}"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Thùng rác 
        <?php 
        $countTrash = CateModel::where("date_deleCate","!=",null)->get();
        ?>
        <?php if(count($countTrash) > 0){ ?>
            <span class="badge badge-light"><?php echo count($countTrash) ?></span>
        <?php } ?>
        </button></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên danh mục</th>
                            <th>Logo</th>
                            <th>Thuộc thể loại</th>
                            <th>Slug</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên danh mục</th>
                            <th>Logo</th>
                            <th>Thuộc thể loại</th>
                            <th>Slug</th>
                            <th>Trạng thái</th>
                            <th>Thao tác </th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php
                        $list = CateModel::where("date_deleCate", "=", null)->get();
                        ?>
                        <?php foreach ($list as $row) { ?>
                            <tr>





                                        <td><?= $row->nameCat ?></td>
                                        <td>
                                             <?php if ($row->logoCate == null) { ?>
                                                    Không có logo
                                             <?php } elseif ((strpos($row->logoCate, '</i>')) == true) { ?>
                                                    <?= $row->logoCate ?>
                                             <?php  } else { ?>
                                                    <img src="{{ asset('upload/img/logo_cate') }}/<?= $row->logoCate ?>" alt="" width="50px" height="50px">
                                             <?php   } ?>
                                        </td>
                                        <td>
                                              <?php if ($row->parent_ID == 0 && $row->parentS_ID == 0) { ?>
                                                         Là thể loại cha
                                             <?php }elseif ($row->parent_ID != 0 && $row->parentS_ID == 0) { ?>
                                                        <?php $cate_son = CateModel::where("categoryId", "=", $row->parent_ID)->first()?>
                                                        Thuộc thể loại <span style="color: #000000; font-weight:bold;"> <?= $cate_son->nameCat ?></span>
                                             <?php } ?>

                                        </td>
                                        <td><?= $row->aliasCat ?></td>
                                        <td>
                                               <?php if ($row->statusCate == 1) { ?>
                                                    <div style="font-weight: bold;" class="text-success">Đang hoạt động</div>
                                              <?php   } elseif ($row->statusCate == 2) { ?>
                                                    <div style="font-weight: bold;" class="text-danger">Đã bị ẩn</div>
                                              <?php } ?>
                                        </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="/admin/cap-nhat-the-loai/<?php echo $row->categoryId ?>"><button type="button" class="btn btn-warning"><i class="fas fa-pen-alt"></i></button></a>
                                        <button data-id="<?= $row->categoryId ?>" type="button" class="btn btn-danger btn_remove_category"><i class="fas fa-arrow-right"></i> <i class="	fas fa-trash-alt"></i></button>
                                    </div>
                                </td>





                            </tr>


                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection