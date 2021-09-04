$(document).ready(function () {
    /*---------------Notice category  Model Open---------------*/
    noticeCategoryAdd = function noticeCategoryAdd() {
        $(".delete-row").trigger('click');
        $("#form-title").html('<i class="fa fa-plus"></i> Add  Notice Category');
        $("#clear_button").show();
        $('#entry-form').modal('show');
        $(".add-row").trigger('click');
        $("#clear_button").on('click', function () {
            clear_form();
        });
    }

    $("#emp_details").on('click', '.delete-row', function () {
        $(this).closest('tr').remove();
    });


    /*------------ save Notice Category----------*/
    $("#save_notice_category").on('click', function () {
        $("#entry-form").val(null).trigger("change");

        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData = new FormData($('#notice_category_form')[0]);

        if ($.trim($('#category_name').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please enter Category Name", "#category_name");
        }else if ($.trim($('#details').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please enter Category Details", "#details");
        } else {
            $.ajax({
                url: url + "/setting/admin/notice-category",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    var response = JSON.parse(data);
                    if (response['result'] == 0) {
                        var errors = response['message'];
                        resultHtml = '<ul>';
                        if(typeof(errors)=='string'){
                            resultHtml += '<li>'+ errors + '</li>';
                        }
                        else{
                            $.each(errors,function (k,v) {
                                resultHtml += '<li>'+ v + '</li>';
                            });
                        }
                        resultHtml += '</ul>';
                        success_or_error_msg('#master_message_div', "danger", resultHtml);
                    }
                    else {
                        toastr['success']('Saved Notice Category Successfully');
                        $('.modal').modal('hide')
                        clear_form();
                        notice_category_datatable.ajax.reload();
                        $("#save_notice_category").html('Save');
                        $("#id").val('');
                    }
                    $(window).scrollTop();
                }
            });
        }
    });

    /*----------------Notice Category Table Data Show---------------*/
    notice_category_datatable = $('#notice_category_table').DataTable({
        destroy: true,
        "order": [[0, 'desc']],
        "processing": true,
        "serverSide": false,
        "ajax": url + "/setting/admin/notice-categories",
        "aoColumns": [
            { mData: 'category_name' },
            { mData: 'details' },
            { mData: 'status', className: "text-center" },
            { mData: 'actions', className: "text-left" },
        ],
        "columnDefs": [
        ],
    });

    /*----------------Notice Category delete-------------------*/
    notice_category_delete = function notice_category_delete(id) {
        var delete_id = id;
        swal({
            title: "Are you sure?",
            text: "You wants to delete item Permanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: url + '/setting/admin/notice-category/delete/' + delete_id,
                    cache: false,
                    success: function (response) {
                        var response = JSON.parse(response);
                        swal(response['message'], {
                            icon: "success",
                        });
                        notice_category_datatable.ajax.reload();
                    }
                });
            }
            else {
                swal("Your Data is safe..!", {
                    icon: "warning",
                });
            }
        });
    }

    //Clear form
    $("#clear_button").on('click', function () {
        clear_form();
    });
    $("#plan_clear_button").on('click', function () {
        $("#plan_table>tbody").html('');
    });


    /*---------------Notice Category Edit------------------- */
    notice_category_edit = function notice_category_edit(id) {

        $("#entry-form").val(null).trigger("change");
        $("#clear_button").trigger('click');
        $("#admin_user_add_button").html("<b> Edit Notice Category</b>");
        var edit_id = id;
        $.ajax({
            url: url + '/setting/admin/notice-category/' + edit_id,
            cache: false,
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response.subject);
                var data = response['noticeCategory'];
                $("#admin_user_add_button").trigger('click');
                $("#save_notice_category").html('Update');
                $("#clear_button").hide();
                $("#details").val(data['details']);
                $("#category_name").val(data['category_name']);
                $("#edit_id").val(data['id']);
                (data['status'] == 'Inactive') ? $("#status").iCheck('uncheck') : $("#status").iCheck('check');
                $('#entry-form').modal('show');
                $(".title").html('<i class="lnr-pencil"></i> Edit Notice Category </h5>');

            }
        });
    }

    /*----------------------Notice Category View----------------------------------------*/
    notice_category_view = function notice_category_view(id) {
        $.ajax({
            url: url + '/setting/admin/notice-category-view/' + id,
            cache: false,
            success: function (response) {
                var response = JSON.parse(response);
                var data = response['notice_category'];
                var statusHtml = (data['status'] == "Active") ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">In-active</span>';
                var modalHtml = "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Category Name :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + data['category_name'] + "</div></div>";
                modalHtml += "<br>";
                modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Category Details :</strong></div>" + "<div class='col-lg-9 col-md-8'>"  + data['details'] + "</div></div>";
                modalHtml += "<br>";

                modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Status :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + statusHtml + "</div></div>";
                modalHtml += "<br>";
                // modalHtml += "<br>";

                $('#myModalLabelLg').html('Notice Category Details');
                $('#modalBodyLg').html(modalHtml);
                $("#generic_modal_lg").modal();
            }
        });
    }
});

