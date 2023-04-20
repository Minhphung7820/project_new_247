$(document).ready(function() {
    $("#name_cate_create").keyup(function(e) {
        e.preventDefault();
        var key = $(this).val();
        if (key != "") {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/Ajax/check_name_cate_create/" + key,
                type: "post",
                success: function(data) {
                    if (data.status == 200) {
                        $(".btnAddCategory").prop("disabled", true);
                        $("#msg_ton_tai_danh_muc").html(data.msg);
                    } else if (data.status == 202) {
                        $(".btnAddCategory").prop("disabled", false);
                        $("#msg_ton_tai_danh_muc").html("");
                    }
                }
            })
        }
    })
    $("#file_logo_create_cate").change(function(e) {
        e.preventDefault();
        if ($(this).val() != "") {
            $("#logo_code_create_cate").val("");
            $("#logo_code_create_cate").prop("disabled", true);
        }
    })
    $("#logo_code_create_cate").keyup(function(e) {
        e.preventDefault();
        if ($(this).val() != "") {
            if ($(this).val() == "i") {
                $(this).val('<i class=""></i>');
            }
            $("#file_logo_create_cate").val("");
            $("#file_logo_create_cate").prop("disabled", true);
        }
    })

    // $(".option_Update_Category").each(function(index, value) {
    //     var id_the_loai = $(value).data("id");
    //     var id_parent = $("#idCateUp").attr("parentid");
    //     if (id_parent == 0) {
    //         $(".option_cate_parent").prop("selected", true);
    //     } else if (id_parent == id_the_loai) {
    //         $(value).prop("selected", true);
    //     }
    // });
})

$(document).on("click", ".btn_remove_category", function(e) {
    e.preventDefault();
    var id_cate_remove = $(this).data("id");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/Ajax/check-category-before-remove/" + id_cate_remove,
        type: "post",
        success: function(data) {
            console.log(data.status);
            if (data.status == 200) {
                swal({
                    title: "Không thể xóa!",
                    text: "Thể loại này đang chứa các thể loại con !",
                    icon: "warning",
                    button: "OK",
                });
            } else if (data.status == 202) {
                swal({
                    title: "Không thể xóa!",
                    text: "Thể loại này đang chứa các bài viết,hãy xóa bài viết trước !",
                    icon: "warning",
                    button: "OK",
                });
            } else if (data.status == 204) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/Ajax/remove-category/" + id_cate_remove,
                    type: "post",
                    success: function(response) {
                        if (response.status == 200) {
                            swal({
                                title: "Đã chuyển vào thùng rác!",
                                text: "Thể loại này đã được chuyển vào thùng rác !",
                                icon: "success",
                                button: false,
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    }
                })
            }
        }
    })
})

$(document).on("click", ".restore_trash_category", function(e) {
    e.preventDefault();
    var id_category_restore = $(this).data("id");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/Ajax/restore-category/" + id_category_restore,
        type: "post",
        success: function(response) {
            if (response.status == 200) {
                swal({
                    title: "Đã khôi phục!",
                    text: "Thể loại này đã được khôi phục lại !",
                    icon: "success",
                    button: false,
                });
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        }
    })
})
$(document).on("click", ".btn_xoa_vinh_vien_the_loai", function(e) {
    e.preventDefault();
    var id_the_loai_xoa_vinh_vien = $(this).data("id");
    swal({
            title: "Bạn có chắc?",
            text: "Xóa vĩnh viễn thể loại tin này ra khỏi Database!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/Ajax/xoa-vinh-vien-the-loai/" + id_the_loai_xoa_vinh_vien,
                    type: "post",
                    success: function(response) {
                        if (response.status == 200) {
                            swal("Xóa thành công một thể loại!", {
                                icon: "success",
                                button: false,
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else if (response.status == 202) {
                            swal("Xóa không thành công !");
                        }
                    }
                })
            } else {
                swal("Thể loại vẫn được giữ nguyên !");
            }
        });
})