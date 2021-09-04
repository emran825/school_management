@extends('layout.master')
@section('content')



<div class="app-main__outer">
    <div class="app-main__inner p-0">
        <div class="app-inner-layout chat-layout">

            <div class="app-inner-layout__wrapper">




                <div class="app-inner-layout__content card">
                    <div class="table-responsive">
                        <div class="app-inner-layout__top-pane">

{{-- ************************************************************************************ --}}
                            <div class="pane-left" id="name_show">
                                {{-- <div class="mobile-app-menu-btn">
                                    <button type="button" class="hamburger hamburger--elastic">
                                        <span class="hamburger-box">
                                            <span class="hamburger-inner"></span>
                                        </span>
                                    </button>
                                </div>
                                <div class="avatar-icon-wrapper mr-2">
                                    <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                    </div>
                                    <div class="avatar-icon avatar-icon-xl rounded"><img width="82" src="assets/images/avatars/1.jpg" alt=""></div>
                                </div>
                                <h4 class="mb-0 text-nowrap">
                                    <a onclick="showProfile()" style="cursor:pointer; text-decoration: none;" id="app_user_name">   Chad Evans</a>

                                    <div class="opacity-7">Last Seen Online: <span class="opacity-8">10 minutes
                                            ago</span></div>
                                </h4> --}}
                            </div>
{{-- *************************************************************************** --}}


                            <div class="pane-right">
                                <div class="btn-group dropdown" id="btn_load">
                                   

                                </div>
                            </div>
                        </div>


                        <div class="chat-wrapper">
                            <div class="chat-box-wrapper">
                                <div>
                                    <div class="avatar-icon-wrapper mr-1">
                                        <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                        </div>
                                        <div class="avatar-icon avatar-icon-lg rounded">
                                            <img src="assets/images/avatars/2.jpg" alt=""></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="chat-box">But I must explain to you how all this mistaken idea of
                                        denouncing pleasure and praising pain was born and I will give you a complete
                                        account of the system.</div>
                                    <small class="opacity-6">
                                        <i class="fa fa-calendar-alt mr-1"></i>
                                        11:01 AM | Yesterday
                                    </small>
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="chat-box-wrapper chat-box-wrapper-right">
                                    <div>
                                        <div class="chat-box">Expound the actual teachings of the great explorer of the
                                            truth, the master-builder of human happiness.</div>
                                        <small class="opacity-6">
                                            <i class="fa fa-calendar-alt mr-1"></i>
                                            11:01 AM | Yesterday
                                        </small>
                                    </div>
                                    <div>
                                        <div class="avatar-icon-wrapper ml-1">
                                            <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                            </div>
                                            <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/2.jpg" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-box-wrapper">
                                <div>
                                    <div class="avatar-icon-wrapper mr-1">
                                        <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                        </div>
                                        <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/2.jpg" alt=""></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="chat-box">But I must explain to you how all this mistaken idea of
                                        denouncing pleasure and praising pain was born and I will give you a complete
                                        account of the system.</div>
                                    <small class="opacity-6">
                                        <i class="fa fa-calendar-alt mr-1"></i>
                                        11:01 AM | Yesterday
                                    </small>
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="chat-box-wrapper chat-box-wrapper-right">
                                    <div>
                                        <div class="chat-box">Denouncing pleasure and praising pain was born and I will
                                            give you a complete account.</div>
                                        <small class="opacity-6">
                                            <i class="fa fa-calendar-alt mr-1"></i>
                                            11:01 AM | Yesterday
                                        </small>
                                    </div>
                                    <div>
                                        <div class="avatar-icon-wrapper ml-1">
                                            <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                            </div>
                                            <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/3.jpg" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-box-wrapper">
                                <div>
                                    <div class="avatar-icon-wrapper mr-1">
                                        <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                        </div>
                                        <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/2.jpg" alt=""></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="chat-box">Born and I will give you a complete account of the system.
                                    </div>
                                    <small class="opacity-6">
                                        <i class="fa fa-calendar-alt mr-1"></i>
                                        11:01 AM | Yesterday
                                    </small>
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="chat-box-wrapper chat-box-wrapper-right">
                                    <div>
                                        <div class="chat-box">The master-builder of human happiness.</div>
                                        <small class="opacity-6">
                                            <i class="fa fa-calendar-alt mr-1"></i>
                                            11:01 AM | Yesterday
                                        </small>
                                    </div>
                                    <div>
                                        <div class="avatar-icon-wrapper ml-1">
                                            <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                            </div>
                                            <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/3.jpg" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-box-wrapper">
                                <div>
                                    <div class="avatar-icon-wrapper mr-1">
                                        <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                        </div>
                                        <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/2.jpg" alt=""></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="chat-box">Mistaken idea of denouncing pleasure and praising pain was
                                        born and I will give you</div>
                                    <small class="opacity-6">
                                        <i class="fa fa-calendar-alt mr-1"></i>
                                        11:01 AM | Yesterday
                                    </small>
                                </div>
                            </div>
                        </div>




                        <div class="app-inner-layout__bottom-pane d-block text-center">
                            <div class="mb-0 position-relative row form-group">



                                {{-- <div class="input-group ">
                                    <input placeholder="Write here and hit enter to send..." type="text" class="form-control-lg form-control">
                                    <div class="input-group-append">
                                      <span class="input-group-text">$</span>
                                      <span class="input-group-text">0.00</span>
                                    </div>
                                  </div> --}}


                                <div class="col-sm-12">
                                    {{-- <input placeholder="Write here and hit enter to send..." type="text" class="form-control-lg form-control">

                                    <div class="input-group ">
                                    <input placeholder="Write here and hit enter to send..." type="text" class="form-control-lg form-control">
                                    <label for="attachment" class="custom-file-upload btn btn-file btn-blue btn-custom-side-padding border-radious-0">
                                        <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                                    </label>
                                    <input multiple id="attachment" name="attachment[]" type="file"/>
                                    <div class="input-group-append">
                                      <span class="input-group-text">$</span>
                                      <span class="input-group-text">0.00</span>
                                    </div>
                                  </div> --}}

                                    <div class="message-input">
                                        <div class="wrap">
                                            <form id="sent_message_to_user" name="sent_message_to_user" enctype="multipart/form-data" class="form form-horizontal form-label-left">
                                                @csrf
                                                <p id="reply_msg" class="replied_message_p"></p>
                                                <input type="hidden" id="edit_msg_id" name="edit_msg_id">
                                                <div class="input-group">

                                                    <input type="hidden" name="app_user_id" id="app_user_id">
                                                    <input placeholder="Write here and hit enter to send..." name="admin_message" id="admin_message" type="text" class="form-control-lg form-control">
                                                    {{-- <input type="text" name="admin_message" id="admin_message" placeholder="Write your message..." /> --}}
                                                    <label for="attachment" class="custom-file-upload btn btn-file btn-blue btn-custom-side-padding border-radious-0">
                                                        <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                                                    </label>
                                                    <input multiple id="attachment" name="attachment[]" type="file" />
                                                    <input type="hidden" id="reply_msg_id" name="reply_msg_id">
                                                    <button class="btn btn-success border-radious-0" type="submit" class="submit" id="message_sent_to_user"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>







                <div class="app-inner-layout__sidebar card">
                    <div class="app-inner-layout__sidebar-header">
                        <ul class="nav flex-column">
                            <li class="pt-4 pl-3 pr-3 pb-3 nav-item">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                    <input placeholder="Search..." id="search_app_user" type="text" class="form-control">
                                </div>
                            </li>
                            <li class="nav-item-header nav-item">Friends Online</li>
                        </ul>
                    </div>
                    <ul class="nav flex-column">
                        @if(\Auth::user()->type =="Student")
                        <div id="app_user_show">

                        </div>
                        {{-- @foreach ($teacher as $teacher)
                        <li class="nav-item" onclick="myFunction({{ $teacher->middle_name }})">
                        <button type="button" tabindex="0" class="dropdown-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-3">
                                        <div class="avatar-icon-wrapper">
                                            <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                            <div class="avatar-icon"><img src="assets/images/avatars/2.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading">{{$teacher->first_name }} {{$teacher->middle_name }}
                                        </div>
                                        <div class="widget-subheading">Aenean vulputate eleifend tellus.</div>
                                    </div>
                                </div>
                            </div>
                        </button>
                        </li>
                        @endforeach --}}
                        @elseif (\Auth::user()->type =="Teacher")
                        <li class="nav-item">
                            <button type="button" tabindex="0" class="dropdown-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="avatar-icon-wrapper">
                                                <div class="badge badge-bottom badge-success badge-dot badge-dot-lg">
                                                </div>
                                                <div class="avatar-icon"><img src="assets/images/avatars/2.jpg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Alina Teacher</div>
                                            <div class="widget-subheading">Aenean vulputate eleifend tellus.</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </li>
                        @endif


                        {{-- <li class="nav-item">
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
                                            <div class="widget-heading">Alina Mcloughlin</div>
                                            <div class="widget-subheading">Aenean vulputate eleifend tellus.</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" tabindex="0" class="dropdown-item active">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="avatar-icon-wrapper">
                                                <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                                <div class="avatar-icon"><img src="assets/images/avatars/3.jpg" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Chad Evans</div>
                                            <div class="widget-subheading">Vivamus elementum semper nisi.</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" tabindex="0" class="dropdown-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="avatar-icon-wrapper">
                                                <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                                <div class="avatar-icon"><img src="assets/images/avatars/3.jpg" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Ella-Rose Henry</div>
                                            <div class="widget-subheading">Etiam sit amet orci eget eros faucibus</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item">
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
                                            <div class="widget-heading">Ruben Tillman</div>
                                            <div class="widget-subheading">Lorem ipsum dolor sit amet, consectetuer</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" tabindex="0" class="dropdown-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="avatar-icon-wrapper">
                                                <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                                <div class="avatar-icon"><img src="assets/images/avatars/3.jpg" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Ella-Rose Henry</div>
                                            <div class="widget-subheading">Etiam sit amet orci eget eros faucibus</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item">
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
                                            <div class="widget-heading">Ruben Tillman</div>
                                            <div class="widget-subheading">Lorem ipsum dolor sit amet, consectetuer</div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </li> --}}
                    </ul>
                    <div class="app-inner-layout__sidebar-footer pb-3">
                        <ul class="nav flex-column">
                            <li class="nav-item-divider nav-item"></li>
                            <li class="nav-item-header nav-item">Offline Friends</li>
                            <li class="text-center p-2 nav-item">
                                <div class="avatar-wrapper avatar-wrapper-overlap">
                                    <div class="avatar-icon-wrapper">
                                        <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                                        <div class="avatar-icon rounded"><img src="assets/images/avatars/5.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="avatar-icon-wrapper">
                                        <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                                        <div class="avatar-icon rounded"><img src="assets/images/avatars/10.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="avatar-icon-wrapper">
                                        <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                                        <div class="avatar-icon rounded"><img src="assets/images/avatars/7.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="avatar-icon-wrapper">
                                        <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                                        <div class="avatar-icon rounded"><img src="assets/images/avatars/8.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="avatar-icon-wrapper">
                                        <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                                        <div class="avatar-icon rounded"><img src="assets/images/avatars/1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="avatar-icon-wrapper">
                                        <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                                        <div class="avatar-icon rounded"><img src="assets/images/avatars/2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="avatar-icon-wrapper">
                                        <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                                        <div class="avatar-icon rounded"><img src="assets/images/avatars/3.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="avatar-icon-wrapper">
                                        <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                                        <div class="avatar-icon rounded"><img src="assets/images/avatars/4.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="avatar-icon-wrapper avatar-icon-add">
                                        <div class="avatar-icon rounded"><i>+</i></div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item-btn text-center nav-item">
                                <button class="btn-wide btn-pill btn btn-success btn-sm">Offline Group
                                    Conversation</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('JScript')
<script>
    var url = $('.site_url').val();
    var number_of_msg = 20;
    var current_page_no = 1;
    var loaded = 1;
    var last_appuser_message_id = 0;

    var msg_image_url = "<?php echo asset('assets/images/message'); ?>";
    var app_user_profile_url = "<?php echo asset('assets/images/user/app_user'); ?>";
    var profile_image_url = "<?php echo asset('assets/images/user/app_user'); ?>";
    var admin_image_url = "<?php echo asset('assets/images/user/admin'); ?>";
     var demo_image_url = "<?php echo asset('assets/images/user/admin/profile.png'); ?>";

    $("select.search-select").select2({
        /* placeholder: "Select a State",*/
        allowClear: true
    });

    //08--Done
    ajaxPreLoad = () => {
        //alert("{{ asset('assets/images/loading.gif') }}")
        $('.content').block({
            overlayCSS: {
                backgroundColor: '#fff'
            }
            , message: '<img src={{ asset('
            assets / images / loading.gif ') }} /> Loading...'
            , css: {
                border: 'none'
                , color: '#333'
                , background: 'none'
            }
        });
    }


    // message_load_type
    // 1: all message dump first time
    // 2: get last message which just entered by admin
    // 3: get load more messages
    // 4: get appusers latest message

    //08--Done
    loadMessages = function loadMessages(message_load_type) {
        //$("#search_app_user").val("");
        // event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var app_user_id = $("#app_user_id").val();
        // new appuser loaded
        if (message_load_type == 1) {
            current_page_no = 1;
        }

        $.ajax({
            url: url + '/message/load-message'
            , type: 'POST'
            , data: {
                app_user_id_load_msg: app_user_id
                , limit: number_of_msg
                , page_no: current_page_no
                , message_load_type: message_load_type
                , last_appuser_message_id: last_appuser_message_id
            }
            , async: true
            , beforeSend: function(xhr) {
                //  ajaxPreLoad()
                //$("#load-content").fadeOut('slow');
            }
            , success: function(response) {
                //alert(1)
                var response = JSON.parse(response);
                var message = response['message'];
                var img_id = "";
                var mc;



                var message_body = "";
                if (!jQuery.isEmptyObject(message)) {



                    //Messages

                    //alert('yaaahh')
                    $.each(message, function(i, message) {
                        var app_user_message = message["app_user_message"];
                        var is_attachment_app_user = message["is_attachment_app_user"];
                        var admin_message = message["admin_message"];
                        var is_attachment = message["is_attachment"];

                        //console.log(message)

                        html = "";
                        date = new Date(message["msg_date"] + 'Z');
                        msg_date = date.toLocaleString()
                        //msg_date 	= date.toLocaleString('default',{ month: 'long', year: 'numeric' });

                        if ((admin_message !== null || is_attachment > 0) && (is_attachment !== '')) {
                            if (message["reply_message"]) {
                                html += '<li class="sent_msg reply" style="margin-bottom: -15px;padding-right: 30px;"><div class="replied_message_p p_div" ">' + message['reply_message'] + '</div></li>  ';
                            }
                            html += '<li class="sent_msg " id="sent_message_id_' + message['id'] + '">';

                            if ($.trim(message['admin_image']) == "null" || $.trim(message['admin_image']) == "") admin_image = "no-user-image.png";
                            else admin_image = message['admin_image'];
                            html += '<img style="width:25px;height:25px; cursor:pointer" title="' + message['admin_name'] + '" src="' + admin_image_url + '/' + admin_image + '" alt="" />';

                            if (message["admin_message"] != null && message["admin_message"] != "") {
                                //alert('<div class="right p_div">'+message["admin_message"]+'</div>')
                                html += '<div class="right p_div">' + message["admin_message"] + '</div><br><br><br>';
                            } else {
                                html += "";
                            }
                            if (message["is_attachment"] == 1) {
                                html += "<div class='attachment_div'>";
                                attachements = message["admin_atachment"].split(',');
                                var old_type = "";
                                for (var i = 0; i < attachements.length; i++) {
                                    var att_type = (attachements[i].split("*"));
                                    var attachment_type = att_type[1];
                                    var attachment_name = att_type[0];
                                    line_break = "";
                                    if (old_type != attachment_type) {
                                        old_type = attachment_type;
                                    }
                                    if (i != 0 && old_type != attachment_type) {
                                        line_break = "<br>";
                                    }

                                    if (attachment_type == 1) {
                                        //Image
                                        html += line_break + '<img  class="zoomImg" style="height:80px !important; width:auto !important;  border-radius:0; cursor:pointer" src="' + msg_image_url + '/' + attachment_name + '" alt="">';
                                        //onclick="zoomImg()"
                                    } else if (attachment_type == 2) {
                                        //Video
                                        html += '<div class="row pull-right text-right"><video style="float:right;margin-right:10px;" width="280" controls><source src="' + msg_image_url + '/' + attachment_name + '" type="video/mp4"></video></div>';
                                    } else if (attachment_type == 3) {
                                        //Audio
                                        html += '<div class="row pull-right text-right"><audio style="float:right;margin-right:10px;" controls><source src="' + msg_image_url + '/' + attachment_name + '" type="audio/mpeg"></audio></div>';
                                    } else {
                                        //Other Files
                                        html += '<a href="' + msg_image_url + '/' + attachment_name + '" download><div class="right p_div"  style="text-decoration:underline">' + attachment_name + '</div></a>';
                                    }
                                }
                                html += "</div>";
                            }
                            html += '</li>';
                            if (message["category_name"] != null && message["category_name"] != "") {
                                mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">' + message["category_name"] + '</div>';
                            } else {
                                mc = "";
                            }

                            if (message["admin_message"] != null && message["admin_message"] != "") tem_msg = "'" + message['admin_message'].replace(/<(?!br\s*\/?)[^>]+>/g, '') + "'";
                            else tem_msg = "";
                            html += '<span class="time_date_sent">' + mc + ' ' + msg_date + '<a href="javascript:void(0)" onclick="removeMessage(' + message["id"] + ',' + tem_msg + ')" class="margin-left-2 text-danger"><i class="clip-remove"></i></a><a href="javascript:void(0)" onclick="editMessage(' + message["id"] + ',' + tem_msg + ')" class="margin-left-2"><i class="fa fa-pencil"></i></a></span>';
                        } else {
                            if (message["admin_reply_message"]) {
                                html += '<li class="sent_msg reply" style="margin-bottom: -15px;padding-right: 30px; "><div style="margin-left: 35px">' + message['admin_reply_message'] + '</div></li>  ';
                            }
                            html += '<li class="receive_msg" id="receive_message_id_' + message['id'] + '">';
                            if ($.trim(message['user_profile_image']) == "null" || $.trim(message['user_profile_image']) == "") appuser_image = "no-user-image.png";
                            else appuser_image = message['user_profile_image'];
                            html += '<img style="width:25px;height:25px;"  src="' + app_user_profile_url + "/" + appuser_image + '" alt="" />';

                            if (message["app_user_message"] != null && message["app_user_message"] != "") {
                                html += '<div class="left p_div">' + message["app_user_message"] + '</div><br>';
                            }
                            if ((message["app_user_message"] != null && message["app_user_message"] != "") && (message["is_attachment_app_user"] == 1)) {
                                html += "";
                            }
                            if (message["is_attachment_app_user"] == 1) {
                                html += "<div class='attachment_div' style=' display: inline-block;  padding:10px 15px 10px 0px;  max-width: 80%;  line-height: 130%;'>";
                                attachements = message["app_user_attachment"].split(',');
                                for (var i = 0; i < attachements.length; i++) {
                                    var att_type = (attachements[i].split("*"));
                                    var attachment_type = att_type[1];
                                    var attachment_name = att_type[0];

                                    if (message["attachment_type"] == 1) {
                                        //Image
                                        html += '<img  class="zoomImg" style="height:80px !important; width:auto !important;  border-radius:0; cursor:pointer" src="' + msg_image_url + '/' + attachment_name + '" alt="">';
                                        //onclick="zoomImg()"
                                    } else if (message["attachment_type"] == 2) {
                                        //Video
                                        html += '<div class="row text-left"><video style="float:left; margin-left:10px" width="280" controls><source src="' + msg_image_url + '/' + attachment_name + '" type="video/mp4"></video></div>';
                                    } else if (message["attachment_type"] == 3) {
                                        //Audio
                                        html += '<div class="row text-left"><audio style="float:left; margin-left:10px" width="280"  controls><source src="' + msg_image_url + '/' + attachment_name + '" type="audio/mpeg"></audio></div>';
                                    } else {
                                        //Other Files
                                        html += '<a href="' + msg_image_url + '/' + attachment_name + '" download><div class="left p_div" style="text-decoration:underline">' + attachment_name + '</div></a>';
                                    }
                                }
                                html += "</div>";
                            }
                            if (message["category_name"] != null && message["category_name"] != "") {
                                mc = '<div class="btn btn-xs btn-info disabled" style="font-size:10px !important;border-radius:7px !important;">' + message["category_name"] + '</div>';
                            } else {
                                mc = "";
                            }

                            if (message["app_user_message"] != null && message["app_user_message"] != "") tem_msg = "'" + message['app_user_message'].replace(/<(?!br\s*\/?)[^>]+>/g, '') + "'";
                            else tem_msg = "";
                            html += '<span class="time_date">' + '<a href="javascript:void(0)" onclick="replyMessage(' + message["id"] + ',' + tem_msg + ')" class="margin-right-2 text-success"><i class="fa fa-mail-reply"></i></a>' + msg_date + ' ' + mc + '</span>';
                            html += '</li>';
                        }
                        message_body = html + message_body;
                    });
                }
                //alert(message_load_type);
                //alert(message_body);
                //loadAppUser();
                if (message_body != "") {
                    if (message_load_type == 1) { // 1: all message dump
                        //alert('1:change all message')
                        $(".message_body").html(message_body);
                        $(".messages").animate({
                            scrollTop: 180000 /*$(document).height()*/
                        }, "fast");
                        current_page_no = 2;
                    }
                    // 2: get last message which just entered by admin
                    // load appuser last message
                    else if (message_load_type == 2 || message_load_type == 4) {
                        //alert('1:add last mesage')
                        var html_tag = $(".message_body");
                        html_tag.append(message_body);
                        $(".messages").animate({
                            scrollTop: 180000 /*$(document).height()*/
                        }, "fast");

                    } else if (message_load_type == 3) { // 3: get load more messages
                        //alert('1:add more all message')
                        // need to specify the las message <li> and make the slide animation accoring to that li
                        $(".messages").animate({
                            scrollTop: $(document).height()
                        }, "fast");
                        var html_tag = $(".message_body");
                        html_tag.prepend(message_body);
                        current_page_no++;
                    }
                    //alert($('.receive_msg:last').length)
                    if ($('.receive_msg:last').length > 0) {
                        //alert('yes')
                        last_app_user_message = $('.receive_msg:last').attr('id').split('_');
                        last_appuser_message_id = last_app_user_message[3];
                    }
                } else {
                    if (message_load_type == 1) {
                        // NO message yet,
                        $(".message_body").html("");
                    }
                }
                // $('.content').unblock();
            }
        });

        $(".zoomImg").click(function() {
            var image_src = $(this).attr('src');
            $("#modalIMG").modal();
            $("#load_zoom_img").attr('src', image_src);
        });

    }

    loadMessageUser = function loadMessageUser(app_user_id) {
        //alert(app_user_id)
        //event.preventDefault()
        //$("#search_app_user").val("");
        // change the last app users message
        last_appuser_message_id = 0;
        //event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url + "/message/view-app-user/" + app_user_id
            , success: function(response) {
                var response = JSON.parse(response);
                console.log(response)
                var data = response['data'];

                $("#app_user_name").html(data['name']);
                $("#app_user_id").val(data['id']);

                if (data['user_profile_image'] != null && data['user_profile_image'] != "") {
                    $("#app_user_image").attr('src', app_user_profile_url + "/" + data['user_profile_image']);
                } else {
                    $("#app_user_image").attr('src', app_user_profile_url + "/no-user-image.png");
                }

                $("#load_more_message").html('<button onclick="loadMessages(3);" style="margin-right: 10px;" type="button" class="btn btn-xs btn-warning">Load More</button>');
                //alert('tesss')
                loadMessages(1); // 1: all message dump

            }
        });
        //window.setInterval(loadMessageUser(app_user_id), 1000);
    }



    //08---done
    set_appmessage_time_out_fn = function set_appmessage_time_out_fn() {
        setTimeout(function() {
            newAppMessages();
        }, 5000);
    }

    //08---done
    newAppMessages = function newAppMessages() {
        if ($('.receive_msg:last').length > 0) {
            last_app_user_message = $('.receive_msg:last').attr('id').split('_');
            last_appuser_message_id = last_app_user_message[3];
        }
        loadMessages(4);
        set_appmessage_time_out_fn();
    }
    newAppMessages();

    //08---done
    replyMessage = (id, msg) => {
        $('#reply_msg_id').val(id)
        $('#reply_msg').html(msg)
    }
    //08---done
    removeMessage = (id, message) => {
        $.ajax({
            url: url + '/message/delete-message/' + id
            , type: 'GET'
            , async: true
            , success: function(response) {
                // need to check whether removed or now
                if ($('#sent_message_id_' + id).prev().hasClass('reply')) {
                    $('#sent_message_id_' + id).prev().remove();
                }
                $('#sent_message_id_' + id).next('span').remove();
                $('#sent_message_id_' + id).remove();


                $('#admin_message').val("");
            }
        })
    }

    //08---done
    editMessage = (id, message) => {
        $('#edit_msg_id').val(id)
        $('#admin_message').val(message)
    }


    searchAppUsers = function searchAppUsers() {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var name = $("#search_app_user").val();
        if (name != "") {
            $.ajax({
                url: url + "/message/search-app-users"
                , type: 'POST'
                , data: {
                    name: name
                }
                , async: true
                , success: function(data) {
                    var app_users = JSON.parse(data);

                    if (!jQuery.isEmptyObject(app_users)) {
                        var html = "";
                        $.each(app_users, function(i, row) {
                            html += '<li class="contact">';
                            html += '<div class="wrap">';
                            if ($.trim(row['user_profile_image']) == "null" || $.trim(row['user_profile_image']) == "") appuser_image = "no-user-image.png";
                            else appuser_image = row['user_profile_image'];
                            html += '<img  src="' + app_user_profile_url + "/" + appuser_image + '" alt="" />';
                            html += '<div class="meta">';
                            html += '<p onclick="loadMessageUser(' + row["id"] + ')" class="name">' + row["name"] + '</p>';
                            //html+='<p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</li>';
                        });
                    }
                    $("#app_user_show").html(html);

                }
            });


        }
    }






    $("#search_app_user").keyup(function() {
        //alert('sdf')
        searchAppUsers();
        if ($("#search_app_user").val() == '') {
            loadAppUser()
        }
    });




    //done
    showProfile = function showProfile() {
        id = $("#app_user_id").val();
        //$("#app_user_id_profile").val(id)
        $.ajax({
            url: url + "/message/view-app-user/" + id
            , success: function(response) {
                var response = JSON.parse(response);
                console.log(response)
                var data = response['data'];
                var groups = response['groups'];

                $("#profile_modal").modal();
                $("#name_div").html('<h5>' + data['name'] + '</h5>');
                $("#contact_div").html(data['contact_no']);
                $("#email_div").html(data['email']);
                $("#nid_div").html(data['nid_no']);
                $("#address_div").html(data['address']);

                $("#group_div").html('<b>Groups: </b><span class="badge badge-warning">' + groups[0]["group_name"] + '</span>');

                if (data['remarks'] != null && data['remarks'] != "") {
                    $("#remarks_div").html('<h5>Profile Details</h5>');
                    $("#remarks_details").html(data['remarks']);
                }

                if (data["user_profile_image"] != null && data["user_profile_image"] != "") {
                    $(".profile_image").html('<img src="' + profile_image_url + '/' + data["user_profile_image"] + '" alt="User Image" class="img img-responsive">');
                } else {
                    $(".profile_image").html('<img src="' + profile_image_url + '/no-user-image.png" alt="User Image" class="img img-responsive">');
                }

                $("#status_btn").removeClass('hide');
                //var class_name = "";
                if (data['status'] == 1) {
                    $("#status_div").html('<b>Status: </b><span class="badge badge-success">Active</span>');
                    //class_name = "btn-success";
                    $("#status_btn").addClass('btn-success');
                    $("#status_btn").removeClass('btn-danger');
                    $("#status_btn").html('Active');
                } else {
                    $("#status_div").html('<b>Status: </b><span class="badge badge-danger">In-active</span>');
                    //class_name = "btn-danger";
                    $("#status_btn").addClass('btn-danger');
                    $("#status_btn").removeClass('btn-success');
                    $("#status_btn").html('In-active');
                }


                //$("#status_btn").addClass(class_name);

            }
        });
    }

    //From profile status change
    $("#status_btn").click(function() {
        var id = $("#app_user_id").val() ? $("#app_user_id").val() : $("#app_user_id_profile").val()

        $.ajax({
            url: url + "/message/change-app-user-status/" + id
            , success: function(response) {
                showProfile(id);
            }
        });
    });

    $.ajax({
        url: url + "/message/get-message-category"
        , success: function(response) {
            var data = JSON.parse(response);
            var option = '<option value="">&nbsp;</option>';
            $.each(data, function(i, data) {
                option += "<option value='" + data['id'] + "'>" + data['category_name'] + "</option>";
            });
            $("#message_category").append(option)
            $('#message_category_group').html(option)
            $("#message_category_group").select2({
                placeholder: "Categoty/Topic"
                , allowClear: true
            });
            $("#message_category").select2({
                placeholder: "Categoty/Topic"
                , allowClear: true
            });
        }
    });

    $('#admin_message').on('keydown', function(e) {
        if (e.which == 13) {
            newMsgSent();
            return false;
        }
    });

</script>


<script src="{{ asset('assets/js/page-js/notification&notice/message.js')}}"></script>

@endsection

