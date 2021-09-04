@extends('layout.master')
@section('content')
    <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>
                                <div class="page-title-head center-elem">
							<span class="d-inline-block pr-2">
								<i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
							</span>
                                    <span class="d-inline-block"> Quizzes </span>
                                </div>
                                <div class="page-title-subheading opacity-10">
                                </div>
                            </div>
                        </div>
                        <div class="page-title-actions">

                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <ul class="nav nav-tabs quiz-tabs">
                                    <li class="nav-item">
                                        <a data-toggle="tab" href="#tab-eg10-0" class="active nav-link" id="quiz_lists">Quizes List</a>
                                    </li>
                                    @if($actions['add_permission']>0)
                                    <li class="nav-item">
                                        <a data-toggle="tab" href="#tab-eg10-1" class="nav-link" id="quiz_title_edit"> Add Quizes</a>
                                    </li>
                                    @endif
                                    <li class="nav-item quiz_view"><a data-toggle="tab" href="#tab-eg10-2" id="quiz_title_view" class="nav-link"></a></li>

                                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg10-3" class="nav-link" id="add_question">Add Questions</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-eg10-0" role="tabpanel">
                                        <div class="card-body pt-1">
                                            <form class="form-inline mb-4 alert alert-info" >
                                                <div class="position-relative form-group search-quiz">
                                                    <select name="year_name" id="year_name" class="form-control mr-2 w-100">
                                                        <option value="default"> Select Key Stage </option>
                                                    </select>
                                                </div>
                                                <div class="position-relative form-group search-quiz">
                                                    <select name="class_name" id="class_name" class="form-control mr-2 w-100">
                                                        <option value="default"> Select Year </option>
                                                    </select>
                                                </div>
                                                <div class="position-relative form-group search-quiz">
                                                    <select name="subject_name" id="subject_name" class="form-control mr-2 w-100">
                                                        <option value="default"> Select Subject </option>
                                                    </select>
                                                </div>
                                                <div class="position-relative form-group search-quiz">
                                                    <select name="topic_title" id="topic_title" class="form-control mr-2 w-100">
                                                        <option value="default"> Select Topic </option>
                                                    </select>
                                                </div>
                                                <div class="position-relative form-group search-quiz">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-fw" aria-hidden="true"></i> Search </button>
                                                </div>
                                            </form>

                                            <table style="width: 100%;" id="quizes_table" class="table table-hover table-striped table-bordered quizes_table">
                                                <thead>
                                                <tr>
                                                    <th width="200px">Quiz Title</th>
                                                    <th>Key Stage</th>
                                                    <th>Year</th>
                                                    <th>Subject</th>
                                                    <th>Topic</th>
                                                    <th>Total Student</th>
                                                    <th>Total Question</th>
                                                    <th width="40px">Status</th>
                                                    <th width="120px">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-eg10-1" role="tabpanel">
                                        <div class="card-body">
                                            <form id="quiz_form" enctype="multipart/form-data" class="form form-horizontal">
                                                @csrf
                                                <input type="hidden" name="edit_id" id="edit_id">
                                                <div class="position-relative row form-group">
                                                    <label for="title" class="col-sm-2 col-form-label">Quiz Title:* </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="title" id="title" placeholder="Quiz Title"  class="form-control">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label for="year_id" class="col-sm-2 col-form-label"> Key Stage:*</label>
                                                    <div class="col-sm-4">
                                                        <select name="year_id" id="year_id" class="form-control">
                                                            <option value="default"> Select Key Stage </option>
                                                            @foreach($keyStages as $keystage)
                                                            <option  value="{{ $keystage->id }}"> {{ $keystage->name }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label for="class_id" class="col-sm-2 col-form-label"> Year:*</label>
                                                    <div class="col-sm-4">
                                                        <select name="class_id" id="class_id" class="form-control"></select>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label for="subject_id" class="col-sm-2 col-form-label">Subject</label>
                                                    <div class="col-sm-4">
                                                        <select name="subject_id" id="subject_id" class="form-control"></select>
                                                    </div>
                                                    <label for="topic_id" class="col-sm-2 col-form-label">Topic</label>
                                                    <div class="col-sm-4">
                                                        <select name="topic_id" id="topic_id" class="form-control"></select>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label for="instruction" class="col-sm-2 col-form-label">Instructions:</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="instruction" id="instruction" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label for="attachment" class="col-sm-2 col-form-label">Optional File</label>
                                                    <div class="col-sm-10">
                                                        <input name="attachment" id="attachment" type="file" class="form-control-file">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group">
                                                    <label for="remote_media_file_link" class="col-sm-2 col-form-label">Remote Media Files:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="remote_media_file_link" id="remote_media_file_link"  class="form-control">
                                                    </div>
                                                </div>
                                                <div class="position-relative form-group pl-1">
                                                    <label>Is Active</label>
                                                    <input type="checkbox" id="is_active" name="is_active" checked="checked" value="1" class="form-control col-lg-12"/>
                                                </div>
                                                <div class="position-relative row form-check">
                                                    <div class="col-sm-10 offset-sm-2">
                                                        <button type="submit" id="save_quiz" class="btn btn-success"> Save</button>
                                                        <button type="button" id="clear_button" class="btn btn-warning">Clear</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-eg10-2" role="tabpanel">
                                        <div id="all_view"></div>
                                        <hr>
                                        <ul class="nav nav-tabs quiz-tabs">
                                            <li class="nav-item"><a data-toggle="tab" href="#questions" class="active nav-link">Quistions</a></li>
                                            <li class="nav-item"><a data-toggle="tab" href="#students" class="nav-link"> Students</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="questions" role="tabpanel">
                                                <div class="card-body pt-1">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-8"><h5> Question Details </h5></div>
                                                            <div class="col-md-1"><h5>Marks</h5></div>
                                                            <div class="col-md-3"><h5>Question Answer</h5></div>
                                                        </div>
                                                        <hr>
                                                        <div id="questionall"></div>

{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-md-8">--}}
{{--                                                                <b>1.  Definition of question (Entry 1 of 2) </b> <br>--}}
{{--                                                                a. an interrogative expression often used to test knowledge<br>--}}
{{--                                                                b. an interrogative sentence or clause<br>--}}
{{--                                                                c. subject or aspect in dispute or open for discussion : issue broadly : problem, matter<br>--}}
{{--                                                                d. subject or point of debate or a proposition to be voted on in a meeting<br>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-1 text-center"> 1 </div>--}}
{{--                                                            <div class="col-md-3">--}}
{{--                                                                b. an interrogative sentence or clause<br>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <hr>--}}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="students" role="tabpanel">
                                                <div class="card-body">
                                                    <table class="table table-bordered table-hover students_table" id="students_table" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Student No.</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Contact No. </th>
                                                            <th class="hidden-xs">Status</th>
                                                            <th width='80' class="text-center">Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>10222</td>
                                                            <td>Rana Hamid </td>
                                                            <td>rana@gmail.com</td>
                                                            <td> 0173585 </td>
                                                            <td class="hidden-xs">active</td>
                                                            <td>Actions</td>
                                                        </tr>
                                                        <tr>
                                                            <td>10222</td>
                                                            <td>Rana Hamid </td>
                                                            <td>rana@gmail.com</td>
                                                            <td> 0173585 </td>
                                                            <td class="hidden-xs">active</td>
                                                            <td>Actions</td>
                                                        </tr>
                                                        <tr>
                                                            <td>10222</td>
                                                            <td>Rana Hamid </td>
                                                            <td>rana@gmail.com</td>
                                                            <td> 0173585 </td>
                                                            <td class="hidden-xs">active</td>
                                                            <td>Actions</td>
                                                        </tr>
                                                        <tr>
                                                            <td>10222</td>
                                                            <td>Rana Hamid </td>
                                                            <td>rana@gmail.com</td>
                                                            <td> 0173585 </td>
                                                            <td class="hidden-xs">active</td>
                                                            <td>Actions</td>
                                                        </tr>
                                                        <tr>
                                                            <td>10222</td>
                                                            <td>Rana Hamid </td>
                                                            <td>rana@gmail.com</td>
                                                            <td> 0173585 </td>
                                                            <td class="hidden-xs">active</td>
                                                            <td>Actions</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-eg10-3" role="tabpanel">
                                        <div class="card-body">
                                            <div class="grid-menu grid-menu-3 col mb-3 ">
                                                <div class="no-gutters row" >
                                                    <div class="col-sm-6 col-xl-3">
                                                        <a data-toggle="tab" href="#multiple-choice"  class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary multiple-choice"><i class="lnr-license btn-icon-wrapper"></i> Multiple choice</a>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-3">
                                                        <a data-toggle="tab"   href="#single-choice"  class="btn-icon-vertical btn-square btn-transition btn btn-outline-secondary single-choice"><i class="lnr-map btn-icon-wrapper"> </i> Single Choice</a>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-3">
                                                        <a data-toggle="tab"  href="#picture-choice" class="btn-icon-vertical btn-square btn-transition btn btn-outline-success picture-choice"><i class="lnr-music-note btn-icon-wrapper"></i> Picture choice</a>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-3">
                                                        <a data-toggle="tab"  href="#true-false" class="btn-icon-vertical btn-square btn-transition btn btn-outline-info true-false"><i class="lnr-heart btn-icon-wrapper"></i> True/false</a>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-3 border-bottom-0">
                                                        <a data-toggle="tab"  href="#free-text" class="btn-icon-vertical btn-square btn-transition btn btn-outline-warning free-text"><i class="lnr-magic-wand btn-icon-wrapper"></i> Free text</a>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-3">
                                                        <a data-toggle="tab"  href="#fill-in-the-blanks" class="btn-icon-vertical btn-square btn-transition btn btn-outline-danger fill-in-the-blanks"><i class="lnr-lighter btn-icon-wrapper"></i> Fill in the blanks</a>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-3">
                                                        <a data-toggle="tab"  href="#match-pair" class="btn-icon-vertical btn-square btn-transition btn btn-outline-info match-pair"><i class="lnr-lighter btn-icon-wrapper"></i> Match pair </a>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-3">
                                                        <a data-toggle="tab"   href="#ordering" class="btn-icon-vertical btn-square btn-transition btn btn-outline-danger ordering"><i class="lnr-lighter btn-icon-wrapper"></i> Ordering</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="container">
                                                    <form id="question_form" autocomplete="off" name="question_form" enctype="multipart/form-data" class="form form-horizontal form-label-left">
                                                        @csrf
                                                        <input type="hidden" id="quiz_id" name="quiz_id"/>
                                                        <input type="hidden" id="type" name="type"/>

                                                        <div class="form-row">
                                                            <div class="col-md-9">
                                                                <div class="position-relative form-group">
                                                                    <label>Question Title <span class="required">*</span></label>
                                                                    <textarea rows="5" cols="100" id="question_detail" name="question_detail" class="form-control col-lg-12"></textarea>
                                                                    <label for="mark" class="">Mark</label>
                                                                    <input type="text" id="mark" name="mark" placeholder="1"  class="form-control col-lg-6"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="position-relative form-group text-center">
                                                                    <span class="btn btn-light btn-file mt-4 mb-2">
                                                                      Upload Audio <input type="file" name="audio" id="audio">
                                                                    </span>
                                                                    <br>
                                                                    <img src="http://localhost/uk-school/public/assets/images/user/admin/no-user-image.png" class="img-thumbnail" id="user_image" width="70%" height="70%">
                                                                    <span class="btn btn-light-grey btn-file bg-light mt-2">
                                                                    <span class="fileupload-new "><i class="fa fa-picture-o"></i> Upload Image</span>
                                                                    <input type="file" name="image" id="image" value="">
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="multiple-choice" role="tabpanel">
                                                                <div class="card-body pt-1" >
                                                                    <div class="form-row">
                                                                        <div class="col-md-10">
                                                                            <div class="position-relative form-group">
                                                                               <h5> Answer </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="position-relative form-group text-center">
                                                                                <button type="button" class="add-row btn btn-info"><i class="fa fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="dynamic_field">
                                                                        <div class="form-row">
                                                                            <div class="col-md-10">
                                                                                <div class="position-relative form-group">
                                                                                    <input type="text" id="question_option_title" name="question_option_title[]" required class="form-control col-lg-12"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="position-relative form-group">
                                                                                    <div class="widget-content-right">
                                                                                        <input name="is_answer[]" type="checkbox" id="is_answer" value="1" />
                                                                                        <button class="border-0 btn-transition btn btn-outline-danger">
                                                                                            <i class="fa fa-trash-alt"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="single-choice" role="tabpanel">
                                                                <div class="card-body">
                                                                    <div class="form-row">
                                                                        <div class="col-md-10">
                                                                            <div class="position-relative form-group">
                                                                                <h5> Answer </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="position-relative form-group text-center">
                                                                                <button type="button" class="add-row-single btn btn-info"><i class="fa fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="single_dynamic_field">
                                                                        <div class="form-row">
                                                                            <div class="col-md-10">
                                                                                <div class="position-relative form-group">
                                                                                    <input type="text" id="question_option_title_single" name="question_option_title_single[]" required class="form-control col-lg-12"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="position-relative form-group">
                                                                                    <div class="widget-content-right">
                                                                                        <input name="is_answer" type="checkbox" id="is_answer" value="1"/>
                                                                                        <button class="border-0 btn-transition btn btn-outline-danger">
                                                                                            <i class="fa fa-trash-alt"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="true-false" role="tabpanel">
                                                                <div class="card-body">
                                                                    <h5> Answer </h5>
                                                                    <div class="form-row">
                                                                        <div class="col-md-10">
                                                                            <div class="position-relative form-group">
                                                                                <input type="text" id="question_option_title_true" name="question_option_title_true" value="true" required class="form-control col-lg-12"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="position-relative form-group">
                                                                                <input name="is_answer" type="checkbox" id="is_answer" value="1"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-10">
                                                                            <div class="position-relative form-group">
                                                                                <input type="text" id="question_option_title_true" name="question_option_title_true" value="false" required class="form-control col-lg-12"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="position-relative form-group">
                                                                                <input name="is_answer" type="checkbox" id="is_answer" value="0"/>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="free-text" role="tabpanel">
                                                                <div class="card-body">
                                                                    <h5> Answer </h5>
                                                                    <div class="form-row">
                                                                        <div class="col-md-12">
                                                                            <div class="position-relative form-group">
                                                                                <textarea rows="2" cols="100" id="question_option_free_text" name="question_option_free_text" class="form-control col-lg-12"></textarea></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="fill-in-the-blanks" role="tabpanel">
                                                                <div class="card-body">
                                                                    <div class="form-row">
                                                                        <div class="col-md-10">
                                                                            <div class="position-relative form-group">
                                                                                <h5> Answer </h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="position-relative form-group text-center">
                                                                                <button type="button" class="add-fill-blank-row btn btn-info"><i class="fa fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="dynamic_fill_blanks">
                                                                        <div class="form-row">
                                                                            <div class="col-md-10">
                                                                                <div class="position-relative form-group">
                                                                                    <input type="text" id="question_option_title_fill_blank" name="question_option_title_fill_blank[]" required class="form-control col-lg-12"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="position-relative form-group">
                                                                                    <div class="widget-content-right">
                                                                                        <button class="border-0 btn-transition btn btn-outline-danger">
                                                                                            <i class="fa fa-trash-alt"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-5">
                                                                <div class="position-relative form-group pl-4">
                                                                    <label>Is Active</label>
                                                                    <input type="checkbox" id="is_active" name="is_active" checked="checked" value="1" class="form-control col-lg-12"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                            </div>
                                                            <div class="col-md-3">
                                                            </div>
                                                        </div>
                                                        <div class="position-relative row form-check">
                                                            <div class="col-sm-10 ">
                                                                <button type="submit" id="save_question" class="btn btn-success"> Save</button>
                                                                <button type="button" id="clear_button" class="btn btn-warning">Clear</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-2'>
                    </div>
                </div>
            </div>
    </div>
    </div>


@endsection
@section('JScript')
    <script type="text/javascript" src="{{ asset('assets/js/page-js/quiz/quiz.js')}}"></script>
@endsection
