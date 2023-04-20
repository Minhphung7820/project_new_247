$(document).ready(function() {
    $("#category_parent_up").change(function(e) {
        e.preventDefault();
        var id_cate_parent_up = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/Ajax/load-category-son-up-news/" + id_cate_parent_up,
            type: "post",
            success: function(r) {
                $("#category_son_up").html(r.msg);
            }
        })
    })
})

$(document).on("click", ".btn_move_news_to_trash", function(e) {
    e.preventDefault();
    var id_news_move_to_trash = $(this).data("id");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/Ajax/move-news-to-trash/" + id_news_move_to_trash,
        type: "post",
        success: function(data) {
            if (data.status == 200) {
                swal({
                    title: "Thành công!",
                    text: "Một bài viết đã dược chuyển vào thùng rác!",
                    icon: "success",
                    button: false,
                });
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else if (data.status == 202) {
                swal({
                    title: "Xóa không được!",
                    text: "Có lỗi khi thực hiện xóa!",
                    icon: "warning",
                    button: "OK",
                });
            }
        }
    })
})

$(document).on("click", ".btn_restore_news", function(e) {
    e.preventDefault();
    var id_news_restore = $(this).data("id");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/Ajax/restore-news-in-trash/" + id_news_restore,
        type: "post",
        success: function(data) {
            if (data.status == 200) {
                swal({
                    title: "Thành công!",
                    text: "Một bài viết đã dược khôi phục!",
                    icon: "success",
                    button: false,
                });
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else if (data.status == 202) {
                swal({
                    title: "Khôi phục không thành công!",
                    text: "Có lỗi khi thực hiện khôi phục!",
                    icon: "warning",
                    button: "OK",
                });
            }
        }
    })
})

$(document).on("click", ".btn_remove_forever_news", function(e) {
    e.preventDefault();
    var id_new_delete_forever = $(this).data("id");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal({
            title: "Bạn có chắc?",
            text: "Xóa vĩnh viễn bài viết ra khỏi Database!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "/Ajax/delete-news-forever/" + id_new_delete_forever,
                    type: "post",
                    success: function(data) {
                        if (data.status == 200) {
                            swal("Xóa thành công! Một bài viết đã được xóa ra khỏi Database!", {
                                icon: "success",
                                button: false
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else if (data.status == 202) {
                            swal("Không thể xóa!", {
                                icon: "warning",
                                button: false
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    }
                })
            } else {
                swal("Bài viết vẫn được giữ nguyên!");
            }
        });

})