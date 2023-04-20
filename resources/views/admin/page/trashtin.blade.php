@extends('admin.layout.master')

@section('tieude')
Thùng rác
@endsection


@section('noidung')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thùng rác bài viết</h1>


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
                            <th>Tiêu đề</th>
                            <th>Ảnh đại diện</th>
                            <th>Slug</th>
                            <th>Thể loại</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Ảnh đại diện</th>
                            <th>Slug</th>
                            <th>Thể loại</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($load as $row) { ?>
                            <tr>
                                <td><?= $row->TieuDe ?></td>
                                <td>
                                    <img src="{{ asset('upload/img/tin') }}/<?= $row->imageNews ?>" alt="" width="150px" height="100px">
                                </td>
                                <td><?= $row->TieuDe_slug ?></td>
                                <td><?= $row->nameCat ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button data-id="<?=$row->newsId ?>" type="button" class="btn btn-success btn_restore_news"><i class="fas fa-sync-alt"></i></button>
                                        <button data-id="<?=$row->newsId ?>" type="button" class="btn btn-danger btn_remove_forever_news"><i class="fas fa-trash-alt"></i></button>
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