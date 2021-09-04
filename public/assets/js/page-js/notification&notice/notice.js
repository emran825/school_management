$(document).ready(function () {
    /*---------------Notice Model Open---------------*/
    noticeAdd = function noticeAdd() {
        $("#form-title").html('<i class="fa fa-plus"></i> Add  Notice');
        $("#clear_button").show();
        $("#save_notice").html('Save');
        $('#entry-form').modal('show');
        $(".add-row").trigger('click');
        $("#clear_button").on('click', function () {
            clear_form();
        });
    }
    $("#emp_details").on('click', '.delete-row', function () {
        $(this).closest('tr').remove();
    });


    /*------------ Save Notice ----------*/
    $("#save_notice").on('click', function () {
        $("#entry-form").val(null).trigger("change");
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = new FormData($('#notice_form')[0]);

        if ($.trim($('#title').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please enter Title", "#title");
        }else if ($.trim($('#notice_category_id').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please Select Notice Type", "#notice_category_id");
        }else if ($.trim($('#details').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please Add deteail", "#details");
        }else if ($.trim($('#notice_date').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please Select Notice Date", "#notice_date");
        }else if ($.trim($('#expire_date').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please Select Expire Date", "#expire_date");
        }else if ($.trim($('#attachment').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please Add Attachment", "#attachment");
        }else {
            $.ajax({
                url: url + "/notice",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    // console.log(data);
                    var response = JSON.parse(data);
                    if (response['result'] == 0) {
                        var errors = response['message'];
                        resultHtml = '<ul>';
                        if (typeof (errors) == 'string') {
                            resultHtml += '<li>' + errors + '</li>';
                        }
                        else {
                            $.each(errors, function (k, v) {
                                resultHtml += '<li>' + v + '</li>';
                            });
                        }
                        resultHtml += '</ul>';
                        success_or_error_msg('#master_message_div', "danger", resultHtml);
                    }
                    else {
                        toastr['success']('Saved Notice Category Successfully');
                        $('.modal').modal('hide')
                        clear_form();
                        notice_datatable.ajax.reload();
                        $("#save_notice").html('Save');

                        $("#id").val('');
                    }
                    $(window).scrollTop();
                }
            });
        }
    });

    /*----------------Notice Table Data Show---------------*/
    notice_datatable = $('#notice_table').DataTable({
        destroy: true,
        "order": [[0, 'desc']],
        "processing": true,
        "serverSide": false,
        "ajax": url + "/notices",
        "aoColumns": [
            { mData: 'title' },
            { mData: 'notice_category_id' },
            { mData: 'notice_date' },
            { mData: 'expire_date' },
            { mData: 'status', className: "text-center" },
            { mData: 'actions', className: "text-left" },
        ],
        "columnDefs": [
        ],
    });

    /*----------------Notice delete-------------------*/
    notice_delete = function notice_delete(id) {
        var delete_id = id;
        swal({
            title: "Are you sure?",
            text: "You wants to delete item parmanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: url + '/notice/delete/' + delete_id,
                    cache: false,
                    success: function (response) {
                        var response = JSON.parse(response);
                        swal(response['message'], {
                            icon: "success",
                        });
                        notice_datatable.ajax.reload();
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
    /*---------------Notice Edit------------------- */

    noticeEdit = function noticeEdit(id) {
        $("#entry-form").val(null).trigger("change");
        $("#clear_button").trigger('click');
        $("#admin_user_add_button").html("<b> Edit Notice</b>");
        var edit_id = id;
        $.ajax({
            url: url + '/notice/' + edit_id,
            cache: false,
            success: function (response) {
                var response = JSON.parse(response);
                //console.log(response.subject);
                var data = response['notice'];
                $("#admin_user_add_button").trigger('click');
                $("#save_notice").html('Update');
                $("#clear_button").hide();
                $("#title").val(data['title']);
                $("#notice_category_id").val(data['notice_category_id']);
                $("#details").val(data['details']);
                $("#notice_date").val(data['notice_date']);
                $("#expire_date").val(data['expire_date']);
                $("#edit_id").val(data['id']);
                $(".attached-file").html("<a target='_blank' href='"+expense_attachment_url+'/'+data["attachment"]+"'>"+data["attachment"]+"</a>");
                (data['status'] == 'Inactive') ? $("#status").iCheck('uncheck') : $("#status").iCheck('check');
                $('#entry-form').modal('show');
                $(".title").html('<i class="lnr-pencil"></i> Edit Notice Category </h5>');

            }
        });
    }

    /*----------------Notice detail View-----------------------*/
    noticeView = function noticeView(id) {
        $.ajax({
            url: url + '/notice-details/' + id,
            cache: false,
            success: function (response) {
                var response = JSON.parse(response);
                var data = response['notice'];
                var statusHtml = (data['status'] == "Active") ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">In-active</span>';
                var modalHtml = "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Notice Title :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + data['title'] + "</div></div>";
                modalHtml += "<br>";
                modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Notice Details :</strong></div>" + "<div class='col-lg-9 col-md-8'>"  + data['details'] + "</div></div>";
                modalHtml += "<br>";
                modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Notice Date :</strong></div>" + "<div class='col-lg-9 col-md-8'>"  + data['notice_date'] + "</div></div>";
                modalHtml += "<br>";
                modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Attachment :</strong></div>" + "<div class='col-lg-9 col-md-8'><a target='_blank' href='"+expense_attachment_url+'/'+data["attachment"]+"'>"+data["attachment"]+"</a></div></div>";
                modalHtml += "<br>";
                modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Expire Date :</strong></div>" + "<div class='col-lg-9 col-md-8'>"  + data['expire_date'] + "</div></div>";
                modalHtml += "<br>";
                modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Status :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + statusHtml + "</div></div>";
                modalHtml += "<br>";
                $('#myModalLabelLg').html('Notice Details');
                $('#modalBodyLg').html(modalHtml);
                $("#generic_modal_lg").modal();
            }
        });
    }

    notice_show = function notice_show(id){
        $.ajax({
        url: url + '/notice-details/' + id,
        cache: false,
        success: function (response) {
            var response = JSON.parse(response);
            var data = response['notice'];
            var statusHtml = (data['status'] == "Active") ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">In-active</span>';
            var modalHtml = "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Notice Title :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + data['title'] + "</div></div>";
            modalHtml += "<br>";
            modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Notice Details :</strong></div>" + "<div class='col-lg-9 col-md-8'>"  + data['details'] + "</div></div>";
            modalHtml += "<br>";
            modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Notice Date :</strong></div>" + "<div class='col-lg-9 col-md-8'>"  + data['notice_date'] + "</div></div>";
            modalHtml += "<br>";
            modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Attachment :</strong></div>" + "<div class='col-lg-9 col-md-8'><a target='_blank' href='"+expense_attachment_url+'/'+data["attachment"]+"'>"+data["attachment"]+"</a></div></div>";
            modalHtml += "<br>";
            modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Expire Date :</strong></div>" + "<div class='col-lg-9 col-md-8'>"  + data['expire_date'] + "</div></div>";
            modalHtml += "<br>";
            modalHtml += "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Status :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + statusHtml + "</div></div>";
            modalHtml += "<br>";
            $('#myModalLabelLg').html('Notice Details');
            $('#modalBodyLg').html(modalHtml);
            $("#generic_modal_lg").modal();
        }
    });
    }

    // Date js code
    var minDate = new Date();
    $("#notice_date").datepicker({
        showAmi: 'drop',
        numberOfMonth: 1,
        minDate: minDate,
        dateFormat: 'yy/mm/dd',
        onClose: function (selectedDate) {
            $('#expire_date').datepicker("option", "minDate", selectedDate);
        }
    });
    $("#expire_date").datepicker({
        showAmi: 'drop',
        numberOfMonth: 1,
        minDate: minDate,
        dateFormat: 'yy/mm/dd',

    });
});

