$(document).ready(function () {
    //for show students list
    class_datatable = $('#class_table').DataTable({
        destroy: true,
        "order": [[ 0, 'desc' ]],
        "processing": true,
        "serverSide": false,
        "ajax": url+"/student-classes",
        "aoColumns": [
           // { data: 'id'},
            { data: 'class_group'},
            { data: 'key_stage_name' },
            { data: 'class_name'},
            { data: 'class_details'},
            { data: 'actions' , className: "text-center"},
        ],

    });

    classSubjectAdd = function classSubjectAdd(id){
        $("#form-title").html('<i class="fa fa-plus"></i> Add  Class Subject');
        $("#clear_button").show();
        $('#subject_table tr:gt(0)').remove();
        $("#save_class_subject").html('Save');
        $('#entry-form').modal('show');
        $.ajax({
            url: url+'/key-stage-class-name/'+id,
            cache: false,
            success: function(response) {
                var response = JSON.parse(response);
                var data = response['classes'];
                $("#class_name").val(data['name']);
                $("#class_id").val(data['id']);
                $("#key_stage_name").val(data['key_stages']['name']);
            }
            });

    }

    //Entry And Update Class and Subject
    $("#save_class_subject").on('click',function(){
        event.preventDefault();
        var formData = new FormData($('#subject_class_form')[0]);
        if($.trim($('#class_name').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter Class Name","#class_name");
        }
        else{
            $.ajax({
                url: url+"/class-subject",
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
                        toastr['error'](resultHtml,  'Failed!!!!');
                    }
                    else{
                        toastr['success']('Class Subject saved successfully',  'Success!!!');
                        $('.modal').modal('hide')
                        class_datatable.ajax.reload();
                        $(this).closest('form').trigger("reset");
                        clear_form();
                        $("#save_class_subject").html('Save');
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
        clear_form();
        $('#subject_table tr:gt(0)').remove();
    });

    //Edit Class Subject
    classSubjectEdit = function classSubjectEdit(id){
        var edit_id = id;
        $("#clear_button").trigger('click');
        $("#form-title").html('<i class="fa fa-edit"></i> Edit Class Subject'+' #ID '+edit_id);
        $.ajax({
            url: url+'/class-subject-view/'+edit_id,
            cache: false,
            success: function(response){
                var response = JSON.parse(response);
                var data = response['classe'];
                $("#clear_button").trigger('click');
                $("#save_class_subject").html('Update');
                $("#clear_button").hide();
                $("#key_stage_name").val(data['keystages']['name'])
                $("#class_name").val(data['name'])
                $("#class_id").val(data['id'])
                if(!jQuery.isEmptyObject(data['subjects'])){
                    var trHtml = "";
                    $.each(data['subjects'], function(i,data){
                        trHtml += ("<tr><td><input type='hidden' name='subject_id[]' value='"+data['id']+"' />"+data['subject_name']+"</td>"+"<td>"+data['subject_details']+"</td>"+"<td width='50px'><button onclick='$(this).parent().parent().remove()' class='btn btn-xs btn-danger'><i class='fa fa-window-close'></i></button></td>"+"</tr>");
                        $("#subject_table").append(trHtml);
                    })
                }
                $("#tbody").html(trHtml);
                $('#id').val(data['id']);
                $('#entry-form').modal('show');
            }
        });
    }

    getSubjectDetails = function getSubjectDetails(id){
        $.ajax({
            url: url+'/subject-autosearch/'+id,
            cache: false,
            success: function(response){
                var response = JSON.parse(response);
                var data = response['subject'];
                var trHtml = "<tr><td><input type='hidden' name='subject_id[]' value='"+data['id']+"' />"+data['subject_name']+"</td>"+"<td>"+data['subject_details']+"</td>"+"<td><button onclick='$(this).parent().parent().remove();' class='btn btn-xs btn-danger'><i class='fa fa-window-close'></i></button></td>"+"</tr>";
                $('#subject_table').append(trHtml);
            }
        });
    }

    //Auto Search Subject
    $("#subject_name").autocomplete({
        search: function() {
        },
        source: function(request, response) {
            $.ajax({
                url: url+'/subjects-auto-suggest',
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
            var callGetSubjectDetails = 1;
            if($("[subject_name='subject_id[]']").length>0){
                $("[subject_name='subject_id[]']").each(function(){
                    if($(this).val() == id) callGetSubjectDetails =0
                })
            }
            if(callGetSubjectDetails)	getSubjectDetails(id);
        },
        close: function( event, ui ) {
            $("#subject_name").trigger("click");
        }
    });

    $("#subject_name").on('click',function(){
        $(this).val("");
    });

    classSubjectView = function classSubjectView(id){
        $.ajax({
            url: url+'/class-subject-view/'+id,
            cache: false,
            success: function(response){
                 var response = JSON.parse(response);
                 var data = response['classe'];
                var classSubjectmodalHtml  ="<div class='container'><div class='row'><h5 class='mt-1'> <b> Classes Information </b></h5> <div class='col-lg-9 col-md-9'> <div class='row mt-2'><div class='col-lg-5 col-md-6 '><strong>Academic Years  :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['keystages']['class_group']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Key Stage:</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['keystages']['name']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Class :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['name']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-5 col-md-6'><strong>Details :</strong></div>"+"<div class='col-lg-7 col-md-6'>"+data['details']+"</div></div>" +
                    "</div></div></div>" +
                    "<hr><h5 class='mt-3'> <b> Academic Information </b></h5>" +
                    "<div class='row'><div class='col-md-12 py-2'><strong>Subject Details</strong></div> <div class='col-lg-12'>" +
                    "<table class='table table-bordered table-hover ' style='width:100% !important'> <thead><tr><th>Name</th><th>Details</th></tr></thead><tbody>";
                if(!jQuery.isEmptyObject(data['subjects'])){
                    var trHtml = "";
                    $.each(data['subjects'], function(i,data){
                        classSubjectmodalHtml 	+= "<tr><td>"+data['subject_name']+"</td>"+"<td>"+data['subject_details']+"</td>"+"</tr>";
                    })
                }
                classSubjectmodalHtml += "</tbody></table></div></div>" +
                    "<div class='row'></div>" +
                    "</div>";
                $('#myModalLabelLg').html('<i class="fa fa-user"></i> Subject Class Details Information');
                $('#modalBodyLg').html(classSubjectmodalHtml);
                $("#generic_modal_lg").modal('show');
            }
        });
    }

});
