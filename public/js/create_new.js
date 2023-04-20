$(document).ready(function() {
    $("#category_parent_create").change(function(e) {
        e.preventDefault();
        var id_cate_option_create = $(this).val();
        if (id_cate_option_create != "") {
            $(".opDefaultCate").hide();
            $("#category_son_create").prop("disabled", false);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/Ajax/load-category-son-create-news/" + id_cate_option_create,
                type: "post",
                success: function(data) {
                    if (data.status == 200) {
                        $("#category_son_create").html(data.msg);
                    }
                }
            })
        } else {
            $("#category_son_create").prop("disabled", true);
            $("#category_son_create").val("");
        }
    })
})