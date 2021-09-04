$(document).ready(function () {

    teacher_datatable = $('#teachers_table').DataTable({
        destroy: true,
        "order": [[ 0, 'desc' ]],
        "processing": true,
        "serverSide": false,
        "ajax": url+"/teachers",
        "aoColumns": [
           // { data: 'id'},
            { data: 'teacher_id'},
            { data: 'name' },
            { data: 'email'},
            { data: 'contact_no'},
            { data: 'status', className: "text-center"},
            { data: 'actions' , className: "text-center"},
        ],
    });
    teacherAdd = function teacherAdd(){
        $("#form-title").html('<i class="fa fa-plus"></i> Add  New Teacher');
        $("#clear_button").show();
        clear_form();
        $('#class_subject_table tbody').html("");
        $('#teacher_id_none').css('display','none');
        $("#save_teacher").html('Save');
        $('#entry-form').modal('show');
    }

    //Entry And Update Teacher
    $("#save_teacher").on('click',function(){
        event.preventDefault();
        var formData = new FormData($('#teacher_form')[0]);

        if ($.trim($('#first_name').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter First name","#first_name");
        }
        else if($.trim($('#email').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter email","#email");
        }
        else if($.trim($('#contact_no').val()) == "" || !($.isNumeric($('#contact_no').val()))){
            success_or_error_msg('#form_submit_error','danger',"Please enter contact no","#contact_no");
        }
        else if($.trim($('#dob').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter date of birth","#dob");
        }else if($.trim($('#nationality').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter Nationality","#nationality");
        }else if($.trim($('#last_qualification').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter Last Qualification","#last_qualification");
        }else if($.trim($('#speciality').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter your ppeciality","#speciality");
        }else if($.trim($('#address').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter your Address","#address");
        }else if($.trim($('#gender').val()) == "default"){
            success_or_error_msg('#form_submit_error','danger',"Please Select Your Gender","#gender");
        }else if($.trim($('#job_type').val()) == "default"){
            success_or_error_msg('#form_submit_error','danger',"Please Select Type Name","#job_type");
        }else if($.trim($('#salary').val()) == "default"){
            success_or_error_msg('#form_submit_error','danger',"Please Enter Salary","#salary");
        }
        else{
            $.ajax({
                url: url+"/teacher",
                type:'POST',
                data:formData,
                async:false,
                cache:false,
                contentType:false,
                processData:false,
                success: function(data){
                    console.log(data)
                    var response = JSON.parse(data);
                    if(response['result'] == 0){
                        var errors	= response['message'];
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
                        toastr['error'](resultHtml,  'Failed!!!!');
                    }
                    else{
                        toastr['success']('Teacher saved successfully',  'Success!!!');
                        $('.modal').modal('hide')
                        teacher_datatable.ajax.reload();
                        $(this).closest('form').trigger("reset");
                        clear_form();
                        $("#save_teacher").html('Save');
                        $("#user_image").attr("src", "src");
                        $("#id").val('');
                    }
                    $(window).scrollTop();
                }
            });
        }
    });

    //Clear form
    $("#clear_button").on('click',function(){
        $("#user_profile_image").attr("src", profile_image_url+"/no-user-image.png");
        clear_form();
    });

    // Teacher edit/update
    teacherEdit = function teacherEdit(id){
        var edit_id = id;
        $("#form-title").html('<i class="fa fa-plus"></i> Edit Teacher');
        $('#teacher_id_none').css('display','block');
        $(this).closest('tbody').trigger("reset");
        $.ajax({
            url: url+'/teacher/'+edit_id,
            cache: false,
            success: function(response){
                var response = JSON.parse(response);
                //console.log(response.student);
                var data = response['teacher'];
                $("#save_teacher").html('Update');
                $("#clear_button").hide();
                $("#teacher_id").val(data['teacher_id']);
                $("#address").val(data['address']);
                $("#email").val(data['email']);
                $("#contact_no").val(data['contact_no']);
                $("#first_name").val(data['first_name']);
                $("#middle_name").val(data['middle_name']);
                $("#last_name").val(data['last_name']);
                $("#dob").val(data['dob']);
                $("#gender").val(data['gender']);
                $("#last_qualification").val(data['last_qualification']);
                $("#nationality").val(data['nationality']);
                $("#speciality").val(data['speciality']);
                $("#job_type").val(data['job_type']);
                $("#salary").val(data['salary']);
                $("#remarks").val(data['remarks']);
                if(response.user["user_profile_image"]==null) response.user['user_profile_image'] = 'no-user-image.png';
                $("#user_image").attr("src", profile_image_url+"/"+response.user["user_profile_image"]);
                if(!jQuery.isEmptyObject(data['teacher_subjects'])){
                    var trHtml = "";
                    $.each(data['teacher_subjects'], function(i,data){
                        trHtml 	+= "<tr><td><input type='hidden' name='subject_id[]' value='"+data['id']+"' />"+data['classes']['key_stages']['name']+"</td>"+"<td>"+data['classes']['name']+"</td>"+"<td>"+data['subjects']['subject_name']+"</td>"+"<td>"+data['subjects']['subject_details']+"</td>"+"<td width='50px'><button onclick='$(this).parent().parent().remove();' class='btn btn-xs btn-danger'><i class='fa fa-window-close'></i></button></td>"+"</tr>";
                    })
                    $('#class_subject_table tbody').html(trHtml);
                }
                $("#id").val(data['id']);
                (data['status']=='Inactive')?$("#is_active").iCheck('uncheck'):$("#is_active").iCheck('checked');
                $('#entry-form').modal('show');

            }
        });
    }

    //Teacher View
    teacherView = function teacherView(id){
        $.ajax({
            url: url+'/teacher/'+id,
            cache: false,
            success: function(response){
                var response = JSON.parse(response);
                var data = response['teacher'];
                if(data['middle_name'] == "" || data['middle_name'] == null){var middle = ""}else{var middle = data['middle_name']}
                if(data['last_name'] == "" || data['last_name'] == null){var last_name = ""}else{var last_name = data['last_name']}
                var teachermodalHtml  ="<div class='container'><div class='row'><h5 class='mt-1'> <b> Personal Information </b></h5><div class='col-lg-9 col-md-9'> <div class='row mt-2'><div class='col-lg-5 col-md-6 '><strong>Student Name  :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['first_name']+" "+middle+" "+last_name+"</div></div>";
                teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Address: :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['address']+"</div></div>";
                teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Email :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['email']+"</div></div>";
                teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Contact No :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['contact_no']+"</div></div>";
                teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Gender :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['gender']+"</div></div>";
                teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Date of Birth :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['dob']+"</div></div>";
                if(data['remarks'] == '' || data['remarks'] == null){
                    teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Remarks :</strong></div>"+"<div class='col-lg-7 col-md-6'> </div></div>";
                }else {
                    teachermodalHtml += "<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Remarks :</strong></div>" + "<div class='col-lg-7 col-md-6'>" + data['remarks'] + "</div></div>";
                }
                teachermodalHtml +="</div><div class='col-lg-3 col-md-3'>";
                if (response.user["user_profile_image"]!=null && response.user["user_profile_image"]!="") {
                    teachermodalHtml +=" <img style='width:100%;' src='" + profile_image_url + "/" + response.user['user_profile_image'] + "' alt='User Image' class='img img-responsive'>";
                } else {
                    teachermodalHtml +="<img style='width:100%;' src='" + profile_image_url + "/no-user-image.png' alt='User Image' class='img img-responsive'>";
                }
                teachermodalHtml += "</div></div>";
                teachermodalHtml +="<hr><h5 class='mt-3'> <b> Academic Information </b></h5> <div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Nationality :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['nationality']+"</div></div>";
                teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Last Qualification :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['last_qualification']+"</div></div>";
                teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Speciality :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['speciality']+"</div></div>";
                teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Type :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['job_type']+"</div></div>";
                teachermodalHtml +="<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Salary :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['salary']+"</div></div>";
                teachermodalHtml += "<hr><h5 class='mt-3'> <b> Assign Class Subject </b></h5>";
                teachermodalHtml +="<div class='row'><div class='col-md-12 py-2'><strong>Subject Details</strong></div> <div class='col-lg-12'>";
                teachermodalHtml +="<table class='table table-bordered table-hover table-striped' style='width:100% !important'> <thead><tr><th>Key Stage</th><th>Year</th><th>Subject</th><th>Subject Details</th></tr></thead><tbody>";
                if(!jQuery.isEmptyObject(data['teacher_subjects'])){
                    var trHtml = "";
                    $.each(data['teacher_subjects'], function(i,data){
                        teachermodalHtml 	+= "<tr><td>"+data['classes']['key_stages']['name']+"</td>"+"<td>"+data['classes']['name']+"</td>"+"<td>"+data['subjects']['subject_name']+"</td>"+"<td>"+data['subjects']['subject_details']+"</td>"+"</tr>";
                    })
                }
                teachermodalHtml += "</tbody></table></div></div>";
                teachermodalHtml += "</div>";
                $('#myModalLabelLg').html('<i class="fa fa-user"></i> Teacher Details Information');
                $('#modalBodyLg').html(teachermodalHtml);
                $("#generic_modal_lg").modal('show');
            }
        });
    }

    // Teacher Delete
    teacherDelete = function teacherDelete(id){
        var del_id = id;
        swal({
            title: "Are you sure?",
            text: "You wants to delete item Permanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: url+'/teacher/delete/'+del_id,
                    cache: false,
                    success: function(data){
                        var response = JSON.parse(data);
                        if(response['result'] == 0){
                            toastr['error']( response['message'], 'Error!!!');
                        }
                        else{
                            toastr['success']( response['message'], 'Success!!!');
                            teacher_datatable.ajax.reload();
                        }
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

    // autosearch get data Subject class Teacher
    getTeacherSubjectDetails = function getTeacherSubjectDetails(id){
        $.ajax({
            url: url+'/subject-autosearch-class/'+id,
            cache: false,
            success: function(response){
                var response = JSON.parse(response);
                var data = response['subjectclass'];
                var trHtml = "<tr>"+"<td><input type='hidden' name='subject_id[]' value='"+data['id']+"' />"+data['classes']['key_stages']['name']+"</td>"+"<td>"+data['classes']['name']+"</td>"+"<td>"+data['subjects']['subject_name']+"</td>"+"<td>"+data['subjects']['subject_details']+"</td>"+"<td><button onclick='$(this).parent().parent().remove();' class='btn btn-xs btn-danger'><i class='fa fa-window-close'></i></button></td>"+"</tr>";
                $('#class_subject_table').append(trHtml);

            }
        });
    }

    // Subject class Teacher Auto Search
    $("#subject_name").autocomplete({
        search: function() {
        },
        source: function(request, response) {
            $.ajax({
                url: url+'/class-subjects-auto-suggest',
                dataType: "json",
                type: "post",
                async:false,
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            var id = ui.item.id;
            $("#subject_name").val("");
            var callGetTeacherSubjectDetails = 1;
            if($("[subject_name='subject_id[]']").length>0){
                $("[subject_name='subject_id[]']").each(function(){
                    if($(this).val() == id) callGetTeacherSubjectDetails =0
                })
            }
            if(callGetTeacherSubjectDetails)	getTeacherSubjectDetails(id);
        },
        close: function( event, ui ) {
            $("#subject_name").trigger("click");
        }
    });
    $("#subject_name").on('click',function(){
        $(this).val("");
    });

});
