$(document).ready(function () {

    // School List
    school_datatable = $('#schools_table').DataTable({
        destroy: true,
        "order": [[ 0, 'desc' ]],
        "processing": true,
        "serverSide": false,
        "ajax": url+"/settings/schools",
        "aoColumns": [
            //{ data: 'id'},
            { data: 'name' },
            { data: 'email'},
            { data: 'contact_no'},
            { data: 'address'},
            { data: 'registration_date'},
            { data: 'status', className: "text-center"},
            { data: 'actions' , className: "text-center"},
        ],
    });

    //School show From
    addSchool = function addSchool(){
        $("#form-title").html('<i class="fa fa-plus"></i> Add  New School');
        $("#clear_button").show();
        $("#save_school").html('Save');
        $('#entry-form').modal('show');
    }

    //School Create
    $("#save_school").on('click',function(){
        event.preventDefault();

        var formData = new FormData($('#school_form')[0]);
        if($.trim($('#name').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please Insert School Name","#name");
        }else if($.trim($('#email').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please Insert Email","#email");
        }else if($.trim($('#contact_no').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please Insert Contact No","#contact_no");
        }else if($.trim($('#principle_name').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please Insert Principle Name","#principle_name");
        }else if($.trim($('#reference_person').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please Insert Reference Person","#reference_person");
        }else if($.trim($('#reference_contact_no').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please Insert Reference Contact No","#reference_contact_no");
        }else if($.trim($('#registration_date').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please Insert Registration Date","#registration_date");
        }
        else{
            $.ajax({
                url: url+"/settings/school",
                type:'POST',
                data:formData,
                async:false,
                cache:false,
                contentType:false,
                processData:false,
                success: function(data){
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

                        toastr['error']( 'Failed!!!!', resultHtml);
                    }

                    else{
                        toastr['success']( 'Save Successfully', ' '+$('#name').val());
                        school_datatable.ajax.reload();
                        clear_form();
                        $('.modal').modal('hide')
                        $("#clear_button").show();
                        $("#form-title").html('<i class="fa fa-plus"></i> Add  New School</h5>');
                        $("#save_school").html('Save');
                        $("#user_image").attr("src", "src");
                        $("#id").val('');
                    }
                    $(window).scrollTop();
                }
            });
        }

    });

    // School View
    school_detail_view = function school_detail_view(id){
        $.ajax({
            url: url+'/settings/school/'+id,
            cache: false,
            success: function(response){
                var response = JSON.parse(response);
                var data = response['school'];

                var schoolmodalHtml  ="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>School Name  :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['name']+"</div></div>";
                schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Address: :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['address']+"</div></div>";
                schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Email :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['email']+"</div></div>";
                schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Contact No :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['contact_no']+"</div></div>";
                schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Principle Name :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['principle_name']+"</div></div>";
                schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Principle Contact No :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['principle_contact_no']+"</div></div>";
                schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Reference Person :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['reference_person']+"</div></div>";
                schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Reference Contact No :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['reference_contact_no']+"</div></div>";
                schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Registration Date :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['registration_date']+"</div></div>";
                if(data['valid_till'] == '' || data['valid_till'] == null){
                    schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Valid Till :</strong></div>"+"<div class='col-lg-9 col-md-8'> </div></div>";
                }else {
                    schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Valid Till :</strong></div>"+"<div class='col-lg-9 col-md-8'>"+data['valid_till']+"</div></div>";
                }
                if(data['remarks'] == '' || data['remarks'] == null){
                    schoolmodalHtml +="<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Remarks :</strong></div>"+"<div class='col-lg-9 col-md-8'> </div></div>";
                }else {
                    schoolmodalHtml += "<div class='row mt-2'><div class='col-lg-3 col-md-4 '><strong>Remarks :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + data['remarks'] + "</div></div>";
                }
                $('#myModalLabelLg').html('<i class="fa fa-user"></i> School Details Information');
                $('#modalBodyLg').html(schoolmodalHtml);
                $("#generic_modal_lg").modal('show');
            }
        });
    }

    // school edit/update
    schoolEdit = function schoolEdit(id){
        var edit_id = id;
        $("#form-title").html('<i class="fa fa-plus"></i> Edit School Info');

        $.ajax({
            url: url+'/settings/school/'+edit_id,
            cache: false,
            success: function(response){
                var response = JSON.parse(response);
                var data = response['school'];

                $("#save_school").html('Update');
                $("#clear_button").hide();

                $("#name").val(data['name']);
                $("#address").val(data['address']);
                $("#email").val(data['email']);
                $("#contact_no").val(data['contact_no']);
                $("#principle_name").val(data['principle_name']);
                $("#principle_contact_no").val(data['principle_contact_no']);
                $("#reference_person").val(data['reference_person']);
                $("#reference_contact_no").val(data['reference_contact_no']);
                $("#registration_date").val(data['registration_date']);
                $("#valid_till").val(data['valid_till']);
                $("#remarks").val(data['remarks']);

                $("#id").val(data['id']);
                (data['status']=='Inactive')?$("#status").iCheck('uncheck'):$("#status").iCheck('checked');
                $('#entry-form').modal('show');
            }
        });
    }

    // school Delete
    schoolDelete = function schoolDelete(id){
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
                    url: url+'/settings/school/delete/'+del_id,
                    cache: false,
                    success: function(data){
                        var response = JSON.parse(data);
                        if(response['result'] == 0){
                            toastr['error']( response['message'], 'Error!!!');
                        }
                        else{
                            toastr['success']( response['message'], 'Success!!!');
                            school_datatable.ajax.reload();
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


    // *************************************  School Admin User  *************************************

    // School Admin User
    SchoolAdminAdd = function SchoolAdminAdd(){
        $("#form-title").html('<i class="fa fa-plus"></i> Add  New School Admin');
        $("#clear_button").show();
        $("#save_school_admin_info").html('Save');
        $('#entry-form').modal('show');
    }

    //Clear form
    $("#clear_button").on('click',function(){
        $("#user_profile_image").attr("src", profile_image_url+"/no-user-image.png");
        clear_form();
    });

    //function for data table
    school_admin_datatable = $('#admin_school_table').DataTable({
        destroy: true,
        "processing": true,
        "serverSide": false,
        "ajax": url+"/school/admins",
        "aoColumns": [
            { mData: 'user_profile_image', className: "text-center"},
            { mData: 'name' },
            { mData: 'school_name' },
            { mData: 'email'},
            { mData: 'status', className: "text-center"},
            { mData: 'actions' , className: "text-center"},
        ],
        "columnDefs": [
            { "width": "130px", "targets":[ 5 ]},
        ],
    });

    // School Admin User Entry And Update
    $('#save_school_admin_info').click(function(event){
        event.preventDefault();

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData = new FormData($('#admin_school_form')[0]);
        if($.trim($('#school_id').val()) == "default"){
            success_or_error_msg('#form_submit_error','danger',"Please Select School name","#school_id");
        }
        else if($.trim($('#first_name').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please insert first name","#first_name");
        }
        else if($.trim($('#contact_no').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please insert contact no","#contact_no");
        }
        else if($.trim($('#email').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please insert Email","#email");
        }
        else{
            $.ajax({
                url: url+"/school/admin",
                type:'POST',
                data:formData,
                async:false,
                cache:false,
                contentType:false,processData:false,
                success: function(data){
                    console.log(data);
                    var response = JSON.parse(data);
                    if(response['result'] == '0'){
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
                        toastr['error']( 'Failed!!!!', resultHtml);
                    }
                    else{
                        toastr['success']( 'Saved Successfully', 'School Admin User '+$('#first_name').val());
                        $('.modal').modal('hide')
                        clear_form();
                        school_admin_datatable.ajax.reload();
                        $("#save_school_admin_info").html("save");
                        $("#user_image").attr("src", "src");
                        $("#id").val('');
                    }
                    $(window).scrollTop();
                }
            });
        }
    });

    //School Admin Edit
    admin_school_edit = function admin_school_edit(id){
        var edit_id = id;
        $.ajax({
            url: url+'/school/admin/'+edit_id,
            cache: false,
            success: function(response){
                console.log(response.data);

                $("#save_school_admin_info").html('Update');

                $("#cancle_admin_update").removeClass('hidden');
                $("#first_name").val(response.data['first_name']);
                $("#last_name").val(response.data['last_name']);
                $("#school_id").val(response.data['school_id']);
                $("#id").val(response.data['id']);
                $("#contact_no").val(response.data['contact_no']);
                $("#email").val(response.data['email']);
                $("#remarks").val(response.data['remarks']);

                if(response.data["user_profile_image"]==null) response.data['user_profile_image'] = 'no-user-image.png';

                $("#user_image").attr("src", profile_image_url+"/"+response.data["user_profile_image"]);
                (response.data['status']==0)?$("#is_active").iCheck('uncheck'):$("#is_active").iCheck('check');

                $('#admin_school_form input#check-all').on('ifChecked', function () {
                    $("#admin_school_form .tableflat").iCheck('check');
                });
                $('#admin_school_form input#check-all').on('ifUnchecked', function () {
                    $("#admin_school_form .tableflat").iCheck('uncheck');
                });
   $("#form-title").html('<i class="lnr-pencil"></i> Edit School Admin #'+response.data['id']+' '+response.data['first_name']+' </h5>');

                $('#entry-form').modal('show');
            }
        });
    }

    //School Admin View
    admin_school_view = function admin_school_view(id){
        var user_id = id;
        $.ajax({
            url: url+'/school/admin/'+user_id,
            success: function(response){
                console.log(response.data['status']);

                $("#profile_modal").modal();
                if(response.data['last_name']=='' || response.data['last_name']==null){
                    $("#name_div").html('<h5>'+response.data['first_name']+'</h5>');
                }else {
                    $("#name_div").html('<h5>'+response.data['first_name']+" "+response.data['last_name']+'</h5>');
                }
                $("#contact_div").html(response.data['contact_no']);
                $("#email_div").html(response.data['email']);
                $("#group_div").html('<span class="badge badge-warning">'+response.groups[0]["group_name"]+'</span>');

                if(response.data['status'] == 1) {
                    $("#status_div").html("<span class='badge badge-success'>Active</span>");
                }else {
                    $("#status_div").html("<span class='badge badge-danger'>In-active</span>");
                }
                if (response.data["user_profile_image"]!=null && response.data["user_profile_image"]!="") {
                    $(".profile_image").html("<img style='width:100%;' src='" + profile_image_url + "/" + response.data['user_profile_image'] + "' alt='User Image' class='img img-responsive'>");
                } else {
                    $(".profile_image").html("<img style='width:100%;' src='" + profile_image_url + "/no-user-image.png' alt='User Image' class='img img-responsive'>");
                }

            }
        });
    }

    //School Admin Delete
    delete_admin_school = function delete_admin_school(id){
        var delete_id = id;
        swal({
            title: "Are you sure?",
            text: "The user will be in-active!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: url+'/school/admin/delete/'+delete_id,
                    cache: false,
                    success: function(response){
                        var response = JSON.parse(response);
                        swal(response['deleteMessage'], {
                            icon: "success",
                        });
                        school_admin_datatable.ajax.reload();
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


});
