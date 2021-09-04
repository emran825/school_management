// All the Setting related js functions will be here
$(document).ready(function () {
    var url = $('.site_url').val();
    var number_of_msg = 20;
    var current_page_no = 1;
    var loaded = 1;
    var last_appuser_message_id = 0;


    var msg_image_url = "<?php echo asset('assets/images/message'); ?>";
    var app_user_profile_url = "<?php echo asset('assets/images/user/app_user'); ?>";
    var profile_image_url = "<?php echo asset('assets/images/user/admin'); ?>";
    var admin_image_url = "<?php echo asset('assets/images/user/admin'); ?>";
    var demo_image_url = "<?php echo asset('assets/images/user/admin/profile.png'); ?>";
  // var demo_image_url = "public/assets/images/user/admin/profile.png";




    console.log('-----------------------IMAGE PRINT------------------------');
    console.log(demo_image_url);


    /*--------------------------------ALL USER SHOW---------------------------*/
    loadAppUser = function loadAppUser() {
        $.ajax({
            url: url + '/message/load-app-user'
            , success: function (response) {
                console.log("----------------------------------------------------response")
                console.log(response);
                console.log("----------------------------------------------------Data");
                console.log(response.data);
                if (!jQuery.isEmptyObject(response.data)) {
                    var html = '';
                    $.each(response.data, function (index, value) {
                        html += `  <li class="nav-item"  onclick="loadMessageUser(` + value.id + `)">
                            <button type="button" tabindex="0" class="dropdown-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="avatar-icon-wrapper">
                                                <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                                <div class="avatar-icon"><img src="assets/images/avatars/2.jpg" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">` + value.first_name + `</div>
                                            <div class="widget-subheading">Aenean vulputate eleifend tellus.</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </li>`;
                    });
                }
                $("#app_user_show").html(html);
                if (localStorage.getItem('app_user_id')) {
                    $('#app_user_id').val(localStorage.getItem('app_user_id'))
                    loadMessageUser(localStorage.getItem('app_user_id'))
                    localStorage.removeItem('app_user_id')
                } else if (loaded == 1) {
                    $('.contact:first').trigger('click');
                    loaded++;
                }
            }
        });
    }
    loadAppUser();
    //08---done
    $("#message_sent_to_user").click(function () {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        newMsgSent();
    });

    //08---done
    newMsgSent = function newMsgSent() {
        var formData = new FormData($('#sent_message_to_user')[0]);
        if (($.trim($('#admin_message').val()) != "" || $.trim($('#attachment').val()) != "") && $.trim($('#app_user_id').val()) != "") {
            $.ajax({
                url: url + "/message/admin-message-sent-to-user"
                , type: 'POST'
                , data: formData
                , async: true
                , cache: true
                , contentType: false
                , processData: false
                , success: function (data) {
                    console.log("--------------------------------------------------------------------------------------");
                    console.log(data);
                    console.log("--------------------------------------------------------------------------------------");
                    // need to confirmation
                    if ($('#edit_msg_id').val() != "") {
                        if (data == 1) {
                            $('#sent_message_id_' + $('#edit_msg_id').val() + '>div').html($.trim($('#admin_message').val()));
                        }
                    } else {
                        loadMessages(2); // 2: last message only
                    }

                    $("#attachment").val('');
                    $('#reply_msg_id').val('')
                    $('#reply_msg').html('')
                    $('#edit_msg_id').val('')
                    $('#admin_message').val("");
                    //$(".messages").animate({ scrollTop:1800000 /*$(document).height()*/ }, "fast");
                    //loadAppUser();
                }
            });
        }
    }

    loadMessageUser = function loadMessageUser(app_user_id) {
        last_appuser_message_id = 0;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url + "/message/view-app-user/" + app_user_id
            , success: function (response) {
                console.log(response)
                var html = '';
                html += `<div class="mobile-app-menu-btn">
                 <button type="button" class="hamburger hamburger--elastic">
                     <span class="hamburger-box">
                         <span class="hamburger-inner"></span>
                     </span>
                 </button>
             </div>
             <div class="avatar-icon-wrapper mr-2">
                 <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                 </div>
                 <div class="avatar-icon avatar-icon-xl rounded" id="image_show"><img id="app_user_image" src="" alt="" /></div>
             </div>
             <h4 class="mb-0 text-nowrap">
                 <a onclick="showProfile()" style="cursor:pointer; text-decoration: none;" id="app_user_name">`+ response.data.first_name + `</a>

                 <div class="opacity-7">Last Seen Online: <span class="opacity-8">10 minutes
                         ago</span></div>
             </h4>`;

                $("#name_show").html(html);

                var button = `<button type="button" onclick="loadMessages(3)"  class="ml-2  btn btn-warning">
                                 Load More
                             </button>`;
                             $("#btn_load").html(button);

                var img = '';
                if (response.data.user_profile_image != null) {
                    //  img+= `<img width="82" src="`+admin_image_url+`'/'`+response.data.user_profile_image+`" alt="">`;
                    $("#app_user_image").attr('src', admin_image_url + "/" + response.data.user_profile_image);
                    //  $("#image_show").html(img);

                } else {
                    // img+= `<img width="82" src="`+demo_image_url+`" alt="">`;
                    // $("#image_show").html(img);
                    $("#app_user_image").attr('src', demo_image_url);

                }
                $("#app_user_id").val(response.data.id);
                loadMessages(1); // 1: all message dump
            }
        });

    }


   








     // message_load_type
        // 1: all message dump first time
        // 2: get last message which just entered by admin
        // 3: get load more messages
        // 4: get appusers latest message

        //08--Done
        loadMessages = function loadMessages(message_load_type){
            //$("#search_app_user").val("");
            // event.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            var app_user_id = $("#app_user_id").val();
            // new appuser loaded
            if(message_load_type == 1){
                current_page_no =1;
            }

            $.ajax({
                url: url+'/message/load-message',
                type:'POST',
                data:{
                    app_user_id_load_msg:app_user_id,
                    limit:number_of_msg,
                    page_no:current_page_no,
                    message_load_type:message_load_type,
                    last_appuser_message_id:last_appuser_message_id
                },
                async:true,
                beforeSend: function( xhr ) {
                  //  ajaxPreLoad()
                    //$("#load-content").fadeOut('slow');
                },
                success: function(response){
                  console.log(response.data)
                }
            });

            $(".zoomImg").click(function(){
                var image_src = $(this).attr('src');
                $("#modalIMG").modal();
                $("#load_zoom_img").attr('src',image_src);
            });

        }

});

