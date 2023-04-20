@extends('admin.layout.master')

@section('tieude')
Quản trị tin tức
@endsection


@section('noidung')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tất cả bài viết</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <a href="{{ route('admin.them_tin') }}"><button type="button" class="btn btn-primary">+ Thêm bài viết mới</button></a>
        <a href="{{ route('admin.thung-rac-tin') }}"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Thùng rác 
        <?php 
        use App\Models\News;
        $countTrash = News::where("date_deleted","!=",null)->get();
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
                            <th>Tiêu đề</th>
                            <th>Ảnh đại diện</th>
                            <th>Tóm tắt</th>
                            <th>Thể loại</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Ảnh đại diện</th>
                            <th>Tóm tắt</th>
                            <th>Thể loại</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($list as $row) { ?>
                            <tr>
                                <td><?= $row->TieuDe ?></td>
                                <td><img src="{{ asset('upload/img/tin') }}/<?= $row->imageNews ?>" alt="" width="150px" height="100px"></td>
                                <td>
                                        <?php echo $row->TomTat ?>
                                </td>
                                <td><div style="color:#000000 ;font-weight:bold;"><?= $row->nameCat ?></div></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="/admin/cap-nhat-tin/<?php echo $row->newsId ?>"><button type="button" class="btn btn-warning"><i class="fas fa-pen-alt"></i></button></a>
                                        <button type="button" data-id="<?=$row->newsId ?>" class="btn btn-danger btn_move_news_to_trash"><i class="	fas fa-trash-alt"></i></button>
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