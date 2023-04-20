@extends('admin.layout.master')

@section('tieude')
Thùng rác
@endsection


@section('noidung')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thùng rác thể loại</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên thể loại</th>
                            <th>Logo</th>
                            <th>Slug</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên thể loại</th>
                            <th>Logo</th>
                            <th>Slug</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($load as $row) { ?>
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
                                <td><?= $row->aliasCat ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" data-id="<?= $row->categoryId ?>" class="btn btn-success restore_trash_category"><i class="fas fa-sync-alt"></i></button>
                                        <button type="button" data-id="<?= $row->categoryId ?>" class="btn btn-danger btn_xoa_vinh_vien_the_loai"><i class="fas fa-trash-alt"></i></button>
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