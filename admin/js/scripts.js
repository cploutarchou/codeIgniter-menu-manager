$(document).ready(function () {


    /**************** Edit Photo Sidebar *****************/
    $(".info-box-header").click(function () {
        $(".inside").slideToggle(400);
        $("#toggle").toggleClass("glyphicon glyphicon-menu-down , glyphicon glyphicon-menu-up");
    });


    let user_href;
    let user_href_slitted;
    let user_id;

    let image_href;
    let image_href_slitted;
    let image_name;
    var image_id;


    $(".modal_thumbnails").click(function () {
        $("#set_user_image").prop('disabled', false);
        $(this).addClass('selected');
        user_href = $("#user-id").prop('href');
        user_href_slitted = user_href.split("=");
        user_id = user_href_slitted[user_href_slitted.length - 1];

        // if need to get multiple image data inside php for each array is better
        // to used $(this) if need to get only one value then preferred way is to
        // use $("#object_id")  or $(".object class")
        image_href = $(this).prop('src');
        image_href_slitted = image_href.split("/");
        image_name = image_href_slitted[image_href_slitted.length - 1];
        image_id = $(this).attr('data');
        console.log(image_id);
        $.ajax({
            url: "includes/ajax_code.php",
            data: {image_id: image_id},
            type: "POST",
            success: function (res) {
                if (res) {
                    $("#modal_sidebar").html(res);
                    // Set image without page refresh using prop jquery function
                    // $(".user_image_box a img").prop('src', '/admin/images/' + response.img);
                } else {
                    swal("Error", response.msg, "error");
                }
            }
        });
    });


    $("#set_user_image").click(function () {
        $("#spinner").show();
        $.ajax({
            url: "includes/ajax_code.php",
            data: {image_name: image_name, user_id: user_id},
            type: "POST",
            success: function (res) {
                response = JSON.parse(res);
                if (res) {
                    $("#spinner").hide();
                    swal("Success", response.msg, "success");
                    // Set image without page refresh using prop jquery function
                    $(".user_image_box a img").prop('src', '/admin/images/' + response.img);
                } else {
                    swal("Error", response.msg, "error");
                }
            }
        })
    });
});

