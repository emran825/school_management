$(document).ready(function () {
    quiz_datatable = $('#quizes_table').DataTable({
        destroy: true,
        "order": [[ 0, 'desc' ]],
        "processing": true,
        "serverSide": false,
        "ajax": url+"/quizes",
        "aoColumns": [
            //{ data: 'id'},
            { data: 'title'},
            { data: 'year_name' },
            { data: 'class_name'},
            { data: 'subject_name'},
            { data: 'topic_name'},
            { data: 'total_student'},
            { data: 'total_question'},
            { data: 'status', className: "text-center"},
            { data: 'actions' , className: "text-center"},
        ],
    });

    questionAdd = function questionAdd(){
        $("#form-title").html('<i class="fa fa-plus"></i> Add  New Question');
        $("#clear_button").show();
        $("#save_question").html('Save');
        $('#entry-form').modal('show');
    }

    //Entry And Update
    $("#save_quiz").on('click',function(){
        event.preventDefault();
        var formData = new FormData($('#quiz_form')[0]);

        if($.trim($('#title').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter Your Name","#title");
        }
        else if($.trim($('#year_id').val()) == "default"){
            success_or_error_msg('#form_submit_error','danger',"Please Select Your Key stage","#year_id");
        }
        else if($.trim($('#class_id').val()) == "default" ){
            success_or_error_msg('#form_submit_error','danger',"Please Select Your Year ","#class_id");
        }
        else if($.trim($('#subject_id').val()) == "default"){
            success_or_error_msg('#form_submit_error','danger',"Please Select Your Subject","#subject_id");
        }else if($.trim($('#topic_id').val()) == "default"){
            success_or_error_msg('#form_submit_error','danger',"Please Select Your Topic","#topic_id");
        } else{
            $.ajax({
                url: url+"/quiz",
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
                        toastr['success']('Quiz saved successfully',  'Success!!!');
                        $('.modal').modal('hide')
                        quiz_datatable.ajax.reload();
                        $(this).closest('form').trigger("reset");
                        clear_form();
                        $("#save_quiz").html('Save');
                        $("#edit_id").val('');
                    }
                    $(window).scrollTop();
                }
            });
        }
    });

    $("#quiz_lists, #clear_button").on('click',function(){
        clear_form();
        $("#clear_button").show();
        $("#save_quiz").html('Save');
        $("#quiz_title_edit").html("Add Quizes");
    });

    quizAdd = function quizAdd(id){
        clear_form();
        $("#clear_button").trigger('click');
        var add_id = id;
        $('#quiz_id').val(add_id);
        $("#add_question").trigger('click');
    };

    // quiz edit/update
    quizEdit = function quizEdit(id){
        clear_form();
        var edit_id = id;
        $("#clear_button").trigger('click');
        $("#clear_button").show();
        $("#quiz_title_edit").html('Edit Quiz');
        $.ajax({
            url: url+'/quiz/'+edit_id,
            cache: false,
            success: function(response){
                var response = JSON.parse(response);
                var data = response['quiz'];
                var years = response['years'];
                var subjects = response['subjects'];
                var topics = response['topics'];
                $("#quiz_title_edit").trigger('click');
                $("#save_quiz").html('Update');
                $("#clear_button").hide();
                $("#title").val(data['title']);
                $("#year_id").val(data['year_id']);
                years.forEach(function (row){
                    $("#class_id").append('<option value="'+row.id+'">'+row.name+' '+row.details+'</option>');
                });
                subjects.forEach(function (row){
                    $("#subject_id").append('<option value="'+row.subjects.id+'">'+row.subjects.subject_name+' '+row.subjects.subject_details+'</option>');
                });
                topics.forEach(function (row){
                    $("#topic_id").append('<option value="'+row.id+'">'+row.topic_name+' '+row.topic_details+'</option>');
                });
                $("#instruction").val(data['instruction']);
                $("#remote_media_file_link").val(data['remote_media_file_link']);
                $("#edit_id").val(data['id']);
                (data['status']=='Inactive')?$("#is_active").iCheck('uncheck'):$("#is_active").iCheck('checked');

            }
        });
    }

    //quiz View
    quizView = function quizView(id){
        $("#clear_button").trigger('click');
        $("#clear_button").show();
        $(".quiz_view").css("display","block");
        $("#quiz_title_view").html('Quiz Details');
        $.ajax({
            url: url+'/quiz/'+id,
            cache: false,
            success: function(response){
                var response = JSON.parse(response);
                var data = response['quiz'];
                var question = response['questions'];
                console.log(question);
                $("#quiz_title_view").trigger('click');
                $("#clear_button").hide();
                var viewquiz = "<div class='container'><div class='row'><h5 class='mt-1'> <b> Quiz Information </b></h5> </div>" +
                    "<div class='row mt-2'><div class='col-lg-4 col-md-4'><strong>Quiz Title:</strong></div>"+"<div class='col-lg-8 col-md-8'>"+data['title']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-4 col-md-4'><strong>Key Stage:</strong></div>"+"<div class='col-lg-8 col-md-8'>"+data['classes']['key_stages']['name']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-4 col-md-4'><strong>Year:</strong></div>"+"<div class='col-lg-8 col-md-8'>"+data['classes']['name']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-4 col-md-4'><strong>Subject:</strong></div>"+"<div class='col-lg-8 col-md-8'>"+data['subjects']['subject_name']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-4 col-md-4'><strong>Topic:</strong></div>"+"<div class='col-lg-8 col-md-8'>"+data['topices']['topic_name']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-4 col-md-4'><strong>Instructions:</strong></div>"+"<div class='col-lg-8 col-md-8'>"+data['instruction']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-4 col-md-4'><strong>Optional File :</strong></div>"+"<div class='col-lg-8 col-md-8'>"+data['year_id']+"</div></div>" +
                    "<div class='row mt-2'><div class='col-lg-4 col-md-4'><strong>Remote Media Files: :</strong></div>"+"<div class='col-lg-8 col-md-8'>"+data['remote_media_file_link']+"</div></div>" +
                    "</div>";
                (data['status']=='Inactive')?$("#is_active").iCheck('uncheck'):$("#is_active").iCheck('checked');
                $('#ids').val(data['id']);

                if(!jQuery.isEmptyObject(question)){
                    var questionall = "";
                    $.each(question, function(i,value){
                        questionall += '<div class="row">' +
                            '<div class="col-md-8">' +
                            '<b>'+value['id']+'.  '+value['question_detail']+' </b> <br>' +
                            'a. an interrogative expression often used to test knowledge<br>' +
                        'b. an interrogative sentence or clause<br>' +
                        'c. subject or aspect in dispute or open for discussion : issue broadly : problem, matter<br>' +
                        'd. subject or point of debate or a proposition to be voted on in a meeting<br>' +
                        '</div>' +
                        '<div class="col-md-1 text-center"> '+value['mark']+' </div>' +
                        '<div class="col-md-3">' +
                        'b. an interrogative sentence or clause<br>' +
                        '</div>' +
                        '</div>' +
                        '<hr>';
                    })
                }
                $('#questionall').html(questionall);
                $('#all_view').html(viewquiz);
            }
        });
    }

    // quiz Delete
    quizDelete = function quizDelete(id){
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
                    url: url+'/quiz/delete/'+del_id,
                    cache: false,
                    success: function(data){
                        var response = JSON.parse(data);
                        if(response['result'] == 0){
                            toastr['error']( response['message'], 'Error!!!');
                        }
                        else{
                            toastr['success']( response['message'], 'Success!!!');
                            quiz_datatable.ajax.reload();
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
    var i=1;
    $('.add-row').click(function(){
      i++;
      $('#dynamic_field').append('<div class="form-row" id="row'+i+'">' +
          '<div class="col-md-10">' +
          '<div class="position-relative form-group">' +
          '<input type="text" id="question_option_title" name="question_option_title[]" required class="form-control col-lg-12"/></div></div>' +
          '<div class="col-md-2">' +
          '<div class="position-relative form-group">' +
          '<div class="widget-content-right">' +
          '<input name="is_answer[]" type="checkbox" id="is_answer" value="1"/>' +
          '<button name="remove" id="'+i+'" class="border-0 btn-transition btn btn-outline-danger btn_remove"><i class="fa fa-trash-alt"></i></button>' +
          '</div>' +
          '</div>' +
          '</div>' +
          '</div>');
    });
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
    });

    var i=1;
    $('.add-row-single').click(function(){
        i++;
        $('#single_dynamic_field').append('<div class="form-row" id="row'+i+'">' +
            '<div class="col-md-10">' +
            '<div class="position-relative form-group">' +
            '<input type="text" id="question_option_title_single" name="question_option_title_single[]" required class="form-control col-lg-12"/></div>' +
            '</div>' +
            '<div class="col-md-2">' +
            '<div class="position-relative form-group">' +
            '<div class="widget-content-right">' +
            '<button name="remove" id="'+i+'" class="border-0 btn-transition btn btn-outline-danger btn_remove"><i class="fa fa-trash-alt"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
    });
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
    });

    var i=1;
    $('.add-fill-blank-row').click(function(){
        i++;
        $('#dynamic_fill_blanks').append('<div class="form-row" id="row'+i+'">' +
            '<div class="col-md-10">' +
            '<div class="position-relative form-group">' +
            '<input type="text" id="question_option_title_fill_blank" name="question_option_title_fill_blank[]" required class="form-control col-lg-12"/></div>' +
            '</div>' +
            '<div class="col-md-2">' +
            '<div class="position-relative form-group">' +
            '<div class="widget-content-right">' +
            '<button name="remove" id="'+i+'" class="border-0 btn-transition btn btn-outline-danger btn_remove"><i class="fa fa-trash-alt"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
    });
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
    });

    $('#year_id').change(function(){
        $("#subject_id").empty();
        $("#topic_id").empty();
        var id = $(this).val();
        if(id){
            $.ajax({
                url: url+('/key-stage-class?key_stage_id=')+id,
                cache: false,
                success: function(response){
                    var response = JSON.parse(response);
                    var data = response['classe'];
                    $('#class_id').empty();
                    $('#class_id').append("<option>Select Year</option>");
                    data.forEach(function (row){
                        $("#class_id").append('<option value="'+row.id+'">'+row.name+' '+row.details+'</option>');
                    });
                }
            })
        }
        else
        {
            $("#class_id").empty();

        }
    });

    $('#class_id').change(function(){
        $('select[name="topic_id"]').empty();
        var id = $(this).val();
        if(id){
            $.ajax({
                url: url+('/class_subject?class_id=')+id,
                cache: false,
                success: function(response){
                    var response = JSON.parse(response);
                    var data = response['classSubject'];
                    jQuery('select[name="subject_id"]').empty();
                    var subjects = '<option value="" disabled selected>Select Subject</option>';
                    data.forEach(function (row){
                        subjects +='<option value="'+row.subjects.id+'">'+row.subjects.subject_name+' '+row.subjects.subject_details+'</option>'
                    });
                    $('select[name="subject_id"]').html(subjects);
                }
            })
        }
        else
        {
            $('select[name="subject_id"]').empty();
        }

    });

    $('#subject_id').change(function(){
        var id = $(this).val();
        if(id){
            $.ajax({
                url: url+('/class-subject-topic?class_subject_topic_id=')+id,
                cache: false,
                success: function(response){
                    var response = JSON.parse(response);
                    var data = response['topics'];

                    jQuery('select[name="topic_id"]').empty();
                    var topic = '<option value="" disabled selected>Select Topic</option>';
                    console.log(data);
                    data.forEach(function (row){
                        topic +='<option value="'+row.id+'">'+row.topic_name+' '+row.topic_details+'</option>'
                    });
                    $('select[name="topic_id"]').html(topic);
                }
            })
        }
        else
        {
            $('select[name="topic_id"]').empty();
        }

    });


    // ========================== Question =====================================

    //Entry And Update
    $("#save_question").on('click',function(){
        event.preventDefault();
        var formData = new FormData($('#question_form')[0]);

        if($.trim($('#question_detail').val()) == ""){
            success_or_error_msg('#form_submit_error','danger',"Please enter Your Question Detail","#question_detail");
        }
        else if($.trim($('#mark').val()) == "default"){
            success_or_error_msg('#form_submit_error','danger',"Please Select Your Mark","#mark");
        }
        else{
            $.ajax({
                url: url+"/question",
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
                        toastr['success']('Question saved successfully',  'Success!!!');
                        $('.modal').modal('hide')
                        quiz_datatable.ajax.reload();
                        $(this).closest('form').trigger("reset");
                        clear_form();
                        $("#save_question").html('Save');
                        $("#id_question").val('');
                    }
                    $(window).scrollTop();
                }
            });
        }
    });

    $('.multiple-choice').on('click', function(){
        var type = "Multiple choice"
        $("#type").val(type);
    });
    $('.single-choice').on('click', function(){
        var type = "Single Choice"
        $("#type").val(type);
    });
    $('.true-false').on('click', function(){
        var type = "True/false"
        $("#type").val(type);
    });
    $('.free-text').on('click', function(){
        var type = "Free text"
        $("#type").val(type);
    });
    $('.fill-in-the-blanks').on('click', function(){
        var type = "Fill in the blanks"
        $("#type").val(type);
    });


});
