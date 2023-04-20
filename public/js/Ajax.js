$(document).ready(function() {
    $(".HEHE").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "/Ajax/test",
            method: "post",
            data: new FormData($("#formtest")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.status == 200) {
                    $("#kq").html(data.msg);
                    $("#myFile").val("");
                } else if (data.status == 202) {
                    $("#kq").html(data.msg);
                }
            }
        });
    });
    $('.CategoryMenu').each(function(index, value) {
        var idCate = $(value).data("id");
        $.ajax({
            url: "/Ajax/loadcategory/" + idCate,
            method: "get",
            success: function(data) {
                if (data.status == 200) {
                    $(value).append(data.msg);
                }
            }
        });
    })
    $(".btncmtNews").click(function(e) {
        e.preventDefault();
        var text = $("#box_message_comment").val();
        if (text != "") {
            $.ajax({
                url: "/comment-news",
                type: "post",
                data: $("#formcmtnews").serialize(),
                success: function(data) {
                    if (data.status == 200) {
                        swal({
                            title: "Thành công!",
                            text: "Bình luận của bạn đã được gửi đi !",
                            icon: "success",
                            button: false,
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else if (data.status == 202) {
                        swal({
                            title: "Thất bại!",
                            text: "Bình luận của bạn không thể gửi !",
                            icon: "warning",
                            button: false,
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else if (data.status == 204) {
                        swal({
                            title: "Vui lòng đăng nhập!",
                            icon: "warning",
                            button: "OK",
                        });
                    }
                }
            });
        } else {
            swal({
                title: "Hãy nhập gì đó !",
                icon: "warning",
                button: "OK",
            });
        }
    })



});

$(document).on("click", ".box_slide_home_news", function(e) {
    e.preventDefault();
    var alias = $(this).data("alias");
    var cate = $(this).data("cate");
    window.location.href = "/tin-" + cate + "/" + alias + ".html";
})
$(document).on("click", ".icon_reply_comment", function(e) {
    e.preventDefault();
    $(this).next().fadeIn(500);
})

$(document).on("submit", "#formReplyCmt", function(e) {
    e.preventDefault();
    var text_msg = $(".reply_message_son").val();

    $.ajax({
        url: "/reply-comment",
        type: "post",
        data: $(this).serialize(),
        success: function(data) {
            if (data.status == 200) {
                swal({
                    title: "Thành công!",
                    text: "Bình luận của bạn đã được gửi đi !",
                    icon: "success",
                    button: false,
                });
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else if (data.status == 202) {
                swal({
                    title: "Thất bại!",
                    text: "Bình luận của bạn không thể gửi !",
                    icon: "warning",
                    button: false,
                });
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else if (data.status == 204) {
                swal({
                    title: "Vui lòng đăng nhập!",
                    icon: "warning",
                    button: "OK",
                });
            } else if (data.status == 206) {
                swal({
                    title: "Hãy nhập gì đó !",
                    icon: "warning",
                    button: "OK",
                });
            }
        }
    });




})
$(document).on("click", ".box_ele_slide_category_news", function(e) {
    e.preventDefault();
    var slug_category = $(this).data("slug");
    window.location.href = "/tin-" + slug_category;
})

$(document).on("click", ".box_el_detail_news_where_category", function(e) {
    e.preventDefault();
    var slug_news = $(this).data("news");
    var slug_cate = $(this).data("cate");
    window.location.href = "/tin-" + slug_cate + "/" + slug_news + ".html";
})
$(document).on("click", ".el_box_news_cate_giai_tri_home", function(e) {
    e.preventDefault();
    var slug_cate_giaitri = $(this).data("cate");
    var slug_news_giaitri = $(this).data("news");
    window.location.href = "/tin-" + slug_cate_giaitri + "/" + slug_news_giaitri + ".html";
})

$(window).scroll(function() {
    if ($(document).scrollTop() > 50) {
        $("#btn_back_to_top").fadeIn(500);
    } else {
        $("#btn_back_to_top").fadeOut(500);
    }
});
$(document).ready(function() {
    $("#btn_back_to_top").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, "fast");
        return false;
    });
});

$(document).on("click", ".box_news_hot_in_side_right_master_4", function(e) {
    e.preventDefault();
    var slug_cate_news_hot = $(this).data("cate");
    var slug_title_news_hot = $(this).data("news");
    window.location.href = "/tin-" + slug_cate_news_hot + "/" + slug_title_news_hot + ".html";
})
$(document).on("click", ".box_slide_news_related_detail", function(e) {
    e.preventDefault();
    var slug_cate_news_related = $(this).data("cate");
    var slug_title_news_related = $(this).data("news");
    window.location.href = "/tin-" + slug_cate_news_related + "/" + slug_title_news_related + ".html";
})

$(document).ready(function() {
    console.log("document ready!");

    var $sticky = $('.sticky_one');
    var $stickyrStopper = $('.sticky-stopper');
    if (!!$sticky.offset()) { // make sure ".sticky" element exists

        var generalSidebarHeight = $sticky.innerHeight();
        var stickyTop = $sticky.offset().top;
        var stickOffset = 0;
        var stickyStopperPosition = $stickyrStopper.offset().top;
        var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;
        var diff = stopPoint + stickOffset;

        $(window).scroll(function() { // scroll event
            var windowTop = $(window).scrollTop(); // returns number

            if (stopPoint < windowTop) {
                $sticky.css({ position: 'absolute', top: diff });
            } else if (stickyTop < windowTop + stickOffset) {
                $sticky.css({ position: 'fixed', top: stickOffset, width: 440 });
            } else {
                $sticky.css({ position: 'absolute', top: 'initial' });
            }
        });

    }
});
$(document).ready(function() {
    console.log("document ready!");

    var $sticky = $('.sticky_two');
    var $stickyrStopper = $('.sticky-stopper');
    if (!!$sticky.offset()) { // make sure ".sticky" element exists

        var generalSidebarHeight = $sticky.innerHeight();
        var stickyTop = $sticky.offset().top;
        var stickOffset = 0;
        var stickyStopperPosition = $stickyrStopper.offset().top;
        var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;
        var diff = stopPoint + stickOffset;

        $(window).scroll(function() { // scroll event
            var windowTop = $(window).scrollTop(); // returns number

            if (stopPoint < windowTop) {
                $sticky.css({ position: 'absolute', top: diff });
            } else if (stickyTop < windowTop + stickOffset) {
                $sticky.css({ position: 'fixed', top: stickOffset, width: 440 });
            } else {
                $sticky.css({ position: 'absolute', top: 'initial' });
            }
        });

    }
});

$(document).on("click", ".box_slide_up_right_news_hot_in_home", function(e) {
    e.preventDefault();
    var slug_cate_box_up_right_news_home = $(this).data("cate");
    var slug_news_box_up_right_news_home = $(this).data("news");
    window.location.href = "/tin-" + slug_cate_box_up_right_news_home + "/" + slug_news_box_up_right_news_home + ".html";
})
$(document).on("click", ".box_slide_down_left_news_hot_in_home", function(e) {
    e.preventDefault();
    var slug_cate_box_down_left_news_home = $(this).data("cate");
    var slug_news_box_down_left_news_home = $(this).data("news");
    window.location.href = "/tin-" + slug_cate_box_down_left_news_home + "/" + slug_news_box_down_left_news_home + ".html";
})

$(document).on("click", ".box_slide_down_right_news_hot_in_home", function(e) {
    e.preventDefault();
    var slug_cate_box_down_right_news_home = $(this).data("cate");
    var slug_news_box_down_right_news_home = $(this).data("news");
    window.location.href = "/tin-" + slug_cate_box_down_right_news_home + "/" + slug_news_box_down_right_news_home + ".html";
})
$(document).ready(function() {
    $("#btn_show_hide_group_social").click(function() {
        $("#btn_grp_connect_social").hide();
        $("#btn_show_hide_group_social_on").show();
    })
    $("#btn_show_hide_group_social_on").click(function() {
        $("#btn_grp_connect_social").show();
        $(this).hide();
    })
})