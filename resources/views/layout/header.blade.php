<div class="app-header header-shadow">
    <div class="app-header__logo">
        <div class="logo-src"><img src="{{ asset('assets/images/admin-upload/')."/".$site_settings['logo']}}" style="max-width:140px" /> </div>

        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header__content">
        <div class="app-header-left">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="close"></button>
            </div>
        </div>
        <div class="app-header-right">
            <div class="header-dots">
                <div class="dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
                        <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                            <span class="icon-wrapper-bg bg-primary"></span>
                            <i class="icon text-primary ion-android-apps"></i>
                        </span>
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                        <div class="dropdown-menu-header">
                            <div class="dropdown-menu-header-inner bg-plum-plate">
                                <div class="menu-header-image" style="background-image: url('assets/theme/assets/images/dropdown-header/abstract4.jpg');"></div>
                                <div class="menu-header-content text-white">
                                    <h5 class="menu-header-title">Quick Access</h5>
                                </div>
                            </div>
                        </div>
                        <div class="grid-menu grid-menu-xl grid-menu-3col">
                            <div class="no-gutters row">
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i class="pe-7s-users icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                        <b>Students</b>
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i class="lnr-graduation-hat icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                        <b>Quiz</b>
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i class="pe-7s-bookmarks icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                        <b>Assignment</b>
                                    </button>
                                </div>
								<div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i class="pe-7s-glasses icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                        <b>Teacher</b>
                                    </button>
                                </div>
								<div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i class="pe-7s-study icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                        <b>Academic</b>
                                    </button>
                                </div>
								<div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i class="pe-7s-speaker icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                        <b>Notification</b>
                                    </button>
                                </div>
								<div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i class="pe-7s-mail icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                        <b>Message</b>
                                    </button>
                                </div>
								<div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i class="pe-7s-tools icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                        <b>Setting</b>
                                    </button>
                                </div>
								<div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i class="pe-7s-note2 icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                       <b> Report</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
                        <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                            <span class="icon-wrapper-bg bg-danger"></span>
                            <i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
                            <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
                        </span>
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                        <div class="dropdown-menu-header mb-0">
                            <div class="dropdown-menu-header-inner bg-deep-blue">
                                <div class="menu-header-image opacity-1" style="background-image: url('assets/theme/assets/images/dropdown-header/city3.jpg');"></div>
                                <div class="menu-header-content text-dark">
                                    <h5 class="menu-header-title">Notifications</h5>
                                    <h6 class="menu-header-subtitle">You have <b>21</b> unread messages</h6>
                                </div>
                            </div>
                        </div>
                        <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                            @php

                             $notice_type_all = App\Models\NoticeCategory::all();;
                           @endphp
                           @foreach ($notice_type_all  as $ke => $notice_type)
                           <li class="nav-item">
                               <a role="tab" class="nav-link  {{ $ke == 0 ? 'active' : '' }}" data-toggle="tab" href="#tab-messages-header{{$notice_type->id}}">
                                   <span>{{$notice_type->category_name  }}</span>
                               </a>
                           </li>
                           @endforeach
                           {{-- <li class="nav-item">
                               <a role="tab" class="nav-link active" data-toggle="tab" href="#tab-messages-header">
                                   <span>Academic</span>
                               </a>
                           </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-events-header">
                                    <span>Message</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-errors-header">
                                    <span>Notice</span>
                                </a>
                            </li> --}}
                        </ul>

                        <div class="tab-content">
                            @foreach ($notice_type_all  as $key =>$notice_type)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="tab-messages-header{{$notice_type->id}}" role="tabpanel">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container">

                                        <div class="p-3">
                                            <div class="notifications-box">
                                                <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                    @php
                                                        $notice = App\Models\Notice::where('notice_category_id',$notice_type->id)->latest()->take(5)->get();
                                                    @endphp
                                                    @foreach ( $notice as  $notice)
                                                    <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">{{$notice->title  }} <a  href="javascript:void(0);" onclick="notice_show({{ $notice->id }})" class="badge badge-success">view</a></h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    {{-- <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">You have been assigned a new Quiz.</h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">Build the production release
                                                                    <span class="badge badge-danger ml-2">NEW</span>
                                                                </h4>
                                                                <span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">Something not important
                                                                    <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                                        <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                            <div class="avatar-icon"><img
                                                                                    src="{{asset('assets/theme/assets/images/avatars/1.jpg')}}"
                                                                                    alt=""></div>
                                                                        </div>
                                                                        <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                                            <div class="avatar-icon"><i>+</i></div>
                                                                        </div>
                                                                    </div>
                                                                </h4>
                                                                <span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-info vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">This dot has an info state</h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">All Hands Meeting</h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">Build the production release
                                                                    <span class="badge badge-danger ml-2">NEW</span>
                                                                </h4>
                                                                <span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">This dot has a dark state</h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                            {{-- <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container">
                                        <div class="p-3">
                                            <div class="notifications-box">
                                                <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                    <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">You have been assigned a new Quiz.</h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">Build the production release
                                                                    <span class="badge badge-danger ml-2">NEW</span>
                                                                </h4>
                                                                <span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">Something not important
                                                                    <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                                        <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                            <div class="avatar-icon"><img
                                                                                    src="{{asset('assets/theme/assets/images/avatars/1.jpg')}}"
                                                                                    alt=""></div>
                                                                        </div>
                                                                        <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                                            <div class="avatar-icon"><i>+</i></div>
                                                                        </div>
                                                                    </div>
                                                                </h4>
                                                                <span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-info vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">This dot has an info state</h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">All Hands Meeting</h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">Build the production release
                                                                    <span class="badge badge-danger ml-2">NEW</span>
                                                                </h4>
                                                                <span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">This dot has a dark state</h4><span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-events-header" role="tabpanel">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container">
                                        <div class="p-3">
                                            <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                                        <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">All Hands Meeting</h4>
                                                            <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p><span class="vertical-timeline-element-date"></span></div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
                                                        <div class="vertical-timeline-element-content bounce-in"><p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                                            <p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span></div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-danger"> </i></span>
                                                        <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">Build the production release</h4>
                                                            <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p><span
                                                                    class="vertical-timeline-element-date"></span></div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>
                                                        <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title text-success">Something not important</h4>
                                                            <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p><span class="vertical-timeline-element-date"></span></div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                                        <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">All Hands Meeting</h4>
                                                            <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p><span class="vertical-timeline-element-date"></span></div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
                                                        <div class="vertical-timeline-element-content bounce-in"><p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                                            <p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span></div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-danger"> </i></span>
                                                        <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">Build the production release</h4>
                                                            <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p><span
                                                                    class="vertical-timeline-element-date"></span></div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>
                                                        <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title text-success">Something not important</h4>
                                                            <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p><span class="vertical-timeline-element-date"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-errors-header" role="tabpanel">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container">
                                        <div class="no-results pt-3 pb-0">
                                            <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                <span class="swal2-success-line-tip"></span>
                                                <span class="swal2-success-line-long"></span>
                                                <div class="swal2-success-ring"></div>
                                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                            </div>
                                            <div class="results-subtitle">All caught up!</div>
                                            <div class="results-title">There are no system errors!</div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item-divider nav-item"></li>
                            <li class="nav-item-btn text-center nav-item">
                                <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest Changes</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    @if(\Auth::check())
                                        @if((\Auth::user()->user_profile_image != ''))
                                            <img width="42px" height="42px;" src="{{ asset('assets/images/user/admin') }}/{{ Auth::user()->user_profile_image }}" class="rounded-circle" >
                                        @else
                                            <img width="42px" height="42px;" src="{{asset('assets/images/user/admin/small/profile.png')}}" class="rounded-circle" >
                                        @endif
                                    @endif
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-info">
                                            <div class="menu-header-image opacity-2" style="background-image: url('assets/theme/assets/images/dropdown-header/city3.jpg');"></div>
                                            <div class="menu-header-content text-left">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">

                                                            @if(\Auth::check())
                                                                @if((\Auth::user()->user_profile_image != ''))
                                                                    <img width="42px" height="42px;" src="{{ asset('assets/images/user/admin') }}/{{ Auth::user()->user_profile_image }}" class="rounded-circle" >
                                                                @else
                                                                    <img width="42px" height="42px;" src="{{asset('assets/images/user/admin/small/profile.png')}}" class="rounded-circle" >
                                                                @endif
                                                            @endif

                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">{{isset(\Auth::user()->first_name) ? \Auth::user()->first_name.' '.\Auth::user()->last_name : ''}}
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right mr-2">
                                                            @if(\Auth::check())
                                                                <a class="btn-pill btn-shadow btn-shine btn btn-focus" href="{{url('auth/logout',isset(\Auth::user()->email) ? \Auth::user()->email : '')}}">
                                                                    <i class="clip-exit"></i>
                                                                    &nbsp;Log Out
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scroll-area-xs" style="height: 150px;">
                                        <div class="scrollbar-container ps">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    @if(\Auth::check())
                                                    <a href="{{url('/profile')}}" class="nav-link">Profile</a>
                                                    @endif
                                                </li>
                                                <li class="nav-item">
                                                    @if(\Auth::check())
                                                    <a href="{{ url('my/profile?tab=change_password') }}" class="nav-link">Change Password </a>
                                                    @endif
                                                </li>
                                                <li class="nav-item">

                                                    <a href="javascript:void(0);" class="nav-link">Messages
                                                        <div class="ml-auto badge badge-warning">512
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="javascript:void(0);" class="nav-link">Notifications
                                                        <div class="ml-auto badge badge-danger">12
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                               {{isset(\Auth::user()->first_name) ? \Auth::user()->first_name.' '.\Auth::user()->last_name : ''}}
                            </div>
                            <div class="widget-subheading">
							{{\Auth::user()->type}}
                            </div>
                        </div>
                        <div class="widget-content-right header-user-info ml-3">
                            <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('assets/js/page-js/notification&notice/notice.js')}}"></script>
    <script>
        function notice_show(id){
            $.ajax({
            url: url + '/notice-details/' + id,
            cache: false,
            success: function (response) {
                var response = JSON.parse(response);
                var data = response['notice'];
                var details = data['subject_details'] ;


                var statusHtml = (data['status'] == "Active") ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">In-active</span>';
                var modalHtml = "<div class='row margin-top-5'><div class='col-lg-3 col-md-4 '><strong>Notice title :</strong></div>" + "<div class='col-lg-9 col-md-8'>" + data['title'] + "</div></div>";
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
                // modalHtml += "<br>";

                $('#myModalLabelLg').html('Notice Details');
                $('#modalBodyLg').html(modalHtml);
                $("#generic_modal_lg").modal();
            }
        });
        }
    </script>
</div>

