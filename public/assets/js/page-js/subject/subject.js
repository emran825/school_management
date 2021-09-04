// All the Setting related js functions will be here
$(document).ready(function () {

    /*---------------Subject Model Open---------------*/
    SubjectAdd = function SubjectAdd() {
        $(".delete-row").trigger('click');
        $("#form-title").html('<i class="fa fa-plus"></i> Add  Subject');
        $("#clear_button").show();
        $("#save_school_admin_info").html('Save');
        $('#entry-form').modal('show');
        $(".add-row").trigger('click');
        $("#clear_button").on('click', function () {
            clear_form();
        });
    }
    $("#emp_details").on('click', '.delete-row', function () {
        $(this).closest('tr').remove();
    });


    /*------------ save subject----------*/
    $("#save_subject").on('click', function () {
        $("#entry-form").val(null).trigger("change");

        event.preventDefault();

        var formData = new FormData($('#subject_form')[0]);

        if ($.trim($('#subject_name').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please enter Subject Name", "#subject_name");
        }

        if ($.trim($('#topic_name').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please enter Topic Name", "#topic_name");
        }
        if ($.trim($('#topic_details').val()) == "") {
            success_or_error_msg('#form_submit_error', 'danger', "Please enter Topic Details", "#topic_details");
        }


        else {
            $.ajax({
                url: url + "/subject",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    var response = JSON.parse(data);
                    if (response['response_code'] == 0) {
                        var errors = response['errors'];
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

                        toastr['success']('Saved Successfully');
                        $('.modal').modal('hide')
                        clear_form();
                        subject_datatable.ajax.reload();
                        $("#save_subject").html('Save');

                        $("#id").val('');
                    }
                    $(window).scrollTop();
                }
            });
        }
    });

    /*----------------Table Data Show---------------*/
    subject_datatable = $('#subject_table').DataTable({
        destroy: true,
        "order": [[0, 'desc']],
        "processing": true,
        "serverSide": false,
        "ajax": url + "/subjects",
        "aoColumns": [
            { mData: 'subject_name' },
            { mData: 'subject_details' },
            { mData: 'status', className: "text-center" },
            { mData: 'actions', className: "text-left" },
        ],
        "columnDefs": [
        ],
    });

    /*----------------Subject delete-------------------*/
    subjectDelete = function subjectDelete(id) {
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
                    url: url + '/subject/delete/' + delete_id,
                    cache: false,
                    success: function (response) {
                        var response = JSON.parse(response);
                        swal(response['message'], {
                            icon: "success",
                        });
                        subject_datatable.ajax.reload();
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
    /*----------------------Topic Row Add-----------*/

    clearPlan = function clearPlan(id) {
        $('.tr_' + id).remove();
    }

    //Clear form
    $("#clear_button").on('click', function () {
        clear_form();
    });

    $("#plan_clear_button").on('click', function () {
        $("#plan_table>tbody").html('');
    });

    createTopicrow = function createTopicrow(arg) {
        var id = (arg.topic_id.length > 0) ? arg.topic_id : '';
        var topic_name = (arg.topic_name.length > 0) ? arg.topic_name : '';
        var topic_details = (arg.topic_details.length > 0) ? arg.topic_details : '';
        var status = (arg.status.length > 0) ? arg.status : '';
        var status_option = (status == "Active") ? "<option value='Active' selected>Active</option> <option value='Inactive'>Inactive</option>" : "<option value='Active' >Active</option> <option selected value='Inactive'>Inactive</option>";
        return ` <tr><td><input type='hidden' class="form-control"  value="`+ arg.topic_id + `" id="topic_id" name='topic_id[]'>
        <input type='text' class="form-control"  value="`+ topic_name + `" id="topic_name" name='topic_name[]'></td>
        <td>  <input type='text' class="form-control" id="topic_details"  value="`+ topic_details + `" name="topic_details[]" ></td>
        <td><select name='status[]' class='form-control '>
            `+ status_option + `
        </select></td>
        <td>
        <button type="button" class="delete-row btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
        </td></tr>`
    }

    $(".add-row").click(function () {
        var topicData = {
            topic_id: " ",
            topic_name: "",
            topic_details: "",
            status: "Active",
        };
        var html = createTopicrow(topicData);
        $("table tbody#emp_details").append(html);
    });

    $("#emp_details").on('click', '.delete-row', function () {
        $(this).closest('tr').remove();
    });

    /*---------------Subject Edit------------------- */

    subjectEdit = function subjectEdit(id) {
        $(".delete-row").trigger('click');
        $("#entry-form").val(null).trigger("change");
        $("#clear_button").trigger('click');
        $('#topic_table tr:gt(0)').remove();
        $("#admin_user_add_button").html("<b> Edit Subject</b>");
        var edit_id = id;
        $.ajax({
            url: url + '/subject/' + edit_id,
            cache: false,
            success: function (response) {
                var response = JSON.parse(response);
                var data = response['subject'];
                var data2 = response['topic'];
                dataItems = data2.map((item) => {
                    var edit_eopic = {
                        topic_id: item.id,
                        topic_name: item.topic_name,
                        topic_details: item.topic_details,
                        status: item.status,
                    }
                    var html = createTopicrow(edit_eopic);
                    $("table tbody#emp_details").append(html);
                });

                $("#admin_user_add_button").trigger('click');
                $("#save_subject").html('Update');
                $("#clear_button").hide();
                $("#subject_details").val(data['subject_details']);
                $("#subject_name").val(data['subject_name']);
                $("#edit_id").val(data['id']);
                (data['status'] == 'Inactive') ? $("#status").iCheck('uncheck') : $("#status").iCheck('check');
                $('#entry-form').modal('show');
                $(".title").html('<i class="lnr-pencil"></i> Edit Subject </h5>');

            }
        });
    }

    //Subject detail View
    subjectView = function subjectView(id) {
        $.ajax({
            url: url + '/subject/' + id,
            cache: false,
            success: function (response) {
                var response = JSON.parse(response);
                var data = response['subject'];
                var details = data['subject_details'] ;
                var sub_details = isEmpty(details);
                function isEmpty(isValue){
                    if(isValue != null){
                        return isValue;
                    }
                    else{
                        return "No Details Found"
                    }
                };

                var statusHtml = (data['status'] == "Active") ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">In-active</span>';
                var modalHtml = "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Subject Name :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + data['subject_name'] + "</div></div><br>" +
                    "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Subject Details :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + sub_details + "</div></div><br>" +
                    "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Status :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + statusHtml + "</div></div><br><br>" +
                    "<table class='table table-bordered' style='width:100% !important'> <thead><tr><th>Topic Name</th><th class='text-center'>Topic Details</th><th class='text-center'>Statuc</th></tr></thead><tbody>";
                if (!jQuery.isEmptyObject(data['topics'])) {
                    $.each(data['topics'], function (i, dta) {
                        var tstatus = (dta['status'] == "Active") ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">In-active</span>';
                        modalHtml += "<tr ><td>" + dta['topic_name'] + "</td>" + "<td class='text-center'>" + dta['topic_details'] + "</td>" + "<td class='text-center'>" + tstatus + "</td>" + "</tr>";
                    });
                    modalHtml += "</tbody></table></td></tr>";
                }
                modalHtml += "</tbody></table></div></div>";
                $('#myModalLabelLg').html('Subject Details');
                $('#modalBodyLg').html(modalHtml);
                $("#generic_modal_lg").modal();
            }
        });
    }
});

