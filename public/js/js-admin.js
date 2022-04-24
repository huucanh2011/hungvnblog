$(function () {
    $(".js-btn-del").click(function () {
        const id = $(this).data("id");
        const type = $(this).data("type");
        $("#js-form-del").attr("action", `/admin/${type}/${id}`);
    });
    $(".js-cancel-btn").click(function () {
        $("#js-form-del").attr("action", "");
    });
    $(".js-del-btn").click(function () {
        $("#js-form-del").submit();
    });

    function renderMessageBox(message, type = "success") {
        $("#message-box").html(
            `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`
        );
    }

    $(".js-status-cbx").change(function (e) {
        e.preventDefault();

        const _token = $("input[name=_token]").val();
        const id = $(this).attr("data-id");
        const is_publish = $(this).prop("checked");

        $.ajax({
            type: "PUT",
            url: `/admin/posts/update-status/${id}`,
            data: JSON.stringify({ _token, is_publish }),
            contentType: "application/json",
        })
            .done(function ({ data, message }) {
                renderMessageBox(message);
                $(`#updated_at_${id}`).html(data.updated_at_formated);
            })
            .fail(function (_msg) {
                renderMessageBox("Có lỗi xảy ra.", "danger");
            })
            .always(function () {
                $("div.alert").delay(4000).fadeOut();
            });
    });

    $(".js-view-post").click(function (e) {
        e.preventDefault();
        let postId = $(this).attr("data-id");
        console.log(postId);

        $.ajax({
            type: "GET",
            url: `/admin/posts/${postId}`,
        })
            .done(function ({ data }) {
                if (data.is_hot) {
                    $("#viewPostModalBody_is_hot").html('<span class="badge badge-info">Tin hot</span>');
                }
                $("#viewPostModalBody_title").html(data.title);
                $("#viewPostModalBody_image").append(
                    $("<img>").attr({
                        src: data.image,
                        class: "w-100 h-100",
                    })
                );
                $("#viewPostModalBody_content").html(data.content);
                $("#viewPostModal").modal("show");
            })
            .fail(function ({ responseJSON }) {
                console.log(responseJSON);
            });
    });

    $(".js-close-view-post").click(function (e) {
        e.preventDefault();
        $("#viewPostModal").modal("hide");
        $("#viewPostModalBody_is_hot").empty();
        $("#viewPostModalBody_title").empty();
        $("#viewPostModalBody_image").empty();
        $("#viewPostModalBody_content").empty();
    });

    $("#btn_image").click(function (e) {
        e.preventDefault();
        $("#input_image").click();
    });

    $("#btn_image_edit").click(function (e) {
        e.preventDefault();
        $("#input_image_edit").click();
    });

    $("#input_image").change(function () {
        const files = this.files;

        if (files.length > 0) {
            if (files[0].size > 2048 * 1000) {
                $("input[id=input_image]").val("");
                alert("Vui lòng chọn ảnh có kích thước nhỏ hơn 2MB.");
                return;
            }

            let reader = new FileReader();
            reader.onload = function (e) {
                console.log(e.target.result);
                $("#image_output").attr("src", e.target.result);
            };
            reader.readAsDataURL(files[0]);

            $("#image_view").show();
        }
    });

    $("#input_image_edit").change(function () {
        const files = this.files;

        if (files.length > 0) {
            if (files[0].size > 2048 * 1000) {
                alert("Vui lòng chọn ảnh có kích thước nhỏ hơn 2MB.");
                return;
            }

            const formData = new FormData();

            formData.append("_token", $("input[name=_token]").val());
            formData.append("post_id", $("#post_id").val());
            formData.append("old_image_name", $("#old_image_name").val());
            formData.append("image", files[0]);

            $.ajax({
                type: "POST",
                url: "/admin/posts/upload-image",
                data: formData,
                contentType: false,
                processData: false,
            })
                .done(function ({ data }) {
                    $("#image_output").attr("src", data.url);
                })
                .fail(function ({ responseJSON }) {
                    console.log(responseJSON);
                });
        }
    });

    $("#image_btn_remove").click(function () {
        $("#image_output").removeAttr("src");
        $("#image_view").hide();
        $("input[id=input_image]").val("");
    });
});
