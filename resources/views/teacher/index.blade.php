@extends('layout.master')
@section('content')
    <div class="app-main__outer">
        @if(\Illuminate\Support\Facades\Auth::user()->type == "School")
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>
                            <div class="page-title-head center-elem">
							<span class="d-inline-block pr-2">
								<i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
							</span>
                                <span class="d-inline-block">Teachers</span>
                            </div>
                            <div class="page-title-subheading opacity-10">
                                <nav class="" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a>
                                                <i aria-hidden="true" class="fa fa-home"></i>&nbsp;Ace Learning
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="{{url('dashboard')}}">Dashboards</a>
                                        </li>
                                        <li class="active breadcrumb-item" aria-current="page">
                                            <a href="{{\Request::url()}}">
                                                {{isset($page_title) ? $page_title : ''}}
                                            </a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="page-title-actions">
                        @if($actions['add_permission']>0)
                            <button type="button" onclick='teacherAdd()' title="Add a New Teacher" data-placement="bottom" class="btn-shadow mr-3 btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Add New Teacher
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-lg-12'>
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <table class="table table-bordered table-hover teachers_table" id="teachers_table" style="width:100% !important">
                                <thead>
                                <tr>
                                    <th>Teacher No.</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Contact No. </th>
                                    <th class="hidden-xs">Status</th>
                                    <th width='80' class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class='col-lg-2'>

                </div>
            </div>
        </div>
            @endif
    </div>
    </div>
    <div class="modal fade" id="entry-form" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="teacher_form" autocomplete="off" name="teacher_form" enctype="multipart/form-data" class="form form-horizontal form-label-left">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="main-card mb-1 card">
                                    <div class="card-body">
                                        <div id="smartwizard">
                                            <ul class="forms-wizard">
                                                <li>
                                                    <a href="#step-1">
                                                        <em>1</em><span>Personal Information</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#step-2">
                                                        <em>2</em><span>Academic Information</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#step-3">
                                                        <em>3</em><span>Assigned Class</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="form-wizard-content">
                                                <div id="step-1">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="form-row" id="teacher_id_none">
                                                                        <div class="col-md-12">
                                                                            <div class="position-relative form-group">
                                                                                <label for="teacher_id" class="">Teacher Number<span class="required">*</span></label>
                                                                                <input type="text" id="teacher_id" name="teacher_id"  class="form-control col-lg-12" readonly/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-12">
                                                                            <div class="position-relative form-group">
                                                                                <label for="first_name" class="">First Name<span class="required">*</span></label>
                                                                                <input type="text" id="first_name" name="first_name" required class="form-control col-lg-12"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="position-relative form-group">
                                                                                <label for="middle_name" class="">Middle Name</label>
                                                                                <input type="text" id="middle_name" name="middle_name" required class="form-control col-lg-12"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="position-relative form-group">
                                                                                <label for="last_name" class="">Last Name</label>
                                                                                <input type="text" id="last_name" name="last_name" required class="form-control col-lg-12"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-4">
                                                                    <label><strong> Teacher Photo</strong></label>
                                                                    <hr>
                                                                    <img src="{{asset('assets/images/user/admin')}}/no-user-image.png" width="70%" height="70%" class="img-thumbnail" id="user_image">
                                                                    <span class="btn btn-light-grey btn-file">
                                                                    <span class="fileupload-new"><i class="fa fa-picture-o"></i> </span>
                                                                    <input type="file" class="form-control col-lg-12" name="user_profile_image" id="user_profile_image" value="">
                                                                </span>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label>Email<span class="required">*</span></label>
                                                                        <input type="email" id="email" name="email" required class="form-control col-lg-12"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label>Contact No<span class="required">*</span></label>
                                                                        <input type="text" id="contact_no" name="contact_no" class="form-control col-lg-12"/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label>Date of Birth <span class="required">*</span></label>
                                                                        <input type="date" id="dob" name="dob" required class="form-control col-lg-12"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label for="gender" class=""> Gender<span class="required">*</span> </label>
                                                                        <select id="gender" name="gender" class="form-control col-lg-12">
                                                                            <option value='Male'>Male</option>
                                                                            <option value='Female'>Female</option>
                                                                            <option value='She-Male'>She-Male</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label>Address<span class="required">*</span></label>
                                                                        <textarea rows="2" cols="100" id="address" name="address" class="form-control col-lg-12"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label>Remarks</label>
                                                                        <textarea rows="2" cols="100" id="remarks" name="remarks" class="form-control col-lg-12"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label for="job_type" class=""> Type <span class="required">*</span> </label>
                                                                        <select id="job_type" name="job_type" class="form-control col-lg-12">
                                                                            <option value='default'>Select Type </option>
                                                                            <option value='Permanent'>Permanent</option>
                                                                            <option value='Part-time'>Part time</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="position-relative form-group">
                                                                        <label>Is Active</label>
                                                                        <input type="checkbox" id="is_active" name="is_active" checked="checked" value="1" class="form-control col-lg-12"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="step-2">
                                                    <div id="accordion" class="accordion-wrapper mb-3">
                                                        <div class="card">
                                                            <div id="headingOne" class="card-header">
                                                                <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                                    <span class="form-heading">Academic Information</span>
                                                                </button>
                                                            </div>
                                                            <div data-parent="#accordion" id="collapseOne" aria-labelledby="headingOne" class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="form-row">
                                                                        <div class="col-md-6">
                                                                            <div class="position-relative form-group">
                                                                                <label for="nationality" class="">Nationality<span class="required">*</span></label>
                                                                                <input type="text" id="nationality" name="nationality" required class="form-control col-lg-12"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="position-relative form-group">
                                                                                <label for="last_qualification" class="">Last Qualification<span class="required">*</span></label>
                                                                                <input type="text" id="last_qualification" name="last_qualification" required class="form-control col-lg-12"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-6">
                                                                            <div class="position-relative form-group">
                                                                                <label for="speciality" class="">Speciality<span class="required">*</span></label>
                                                                                <input type="email" id="speciality" name="speciality" required class="form-control col-lg-12"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="position-relative form-group">
                                                                                <label for="salary"> Salary<span class="required">*</span> </label>
                                                                                <input name="salary" id="salary" type="text" class="form-control"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="step-3">
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-row">
                                                                <div class="col-md-12 "><b> Search and add Subjects for this Teacher</b></div>
                                                            </div>
                                                            <div class="form-row ">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-6" ></label>
                                                                <div class="col-md-12 well">
                                                                    <input type="text" id="subject_name" name="subject_name" autocomplete="off" placeholder="Search Subject name" class="form-control col-lg-12 bordered" />
                                                                    </br>
                                                                       <table class="table table-bordered table-hover class_subject_table" id="class_subject_table" style="width:100% !important">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>Key Stage</th>
                                                                                <th>Year</th>
                                                                                <th>Subject</th>
                                                                                <th>Subject Details</th>
                                                                                <th width="50px"></th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            </tbody>
                                                                        </table>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="clearfix">
                                            <button type="button" id="next-btn" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Next</button>
                                            <button type="button" id="prev-btn" class="btn-shadow float-right btn-wide btn-pill mr-3 btn btn-outline-secondary">Previous</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="form_submit_error" class="text-center" style="display:none"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12" style="display: flex; flex-direction: row;">
                        <div class="col-md-3 text-left">
                            <button type="submit" id="save_teacher" class="btn btn-success  btn-lg btn-block">Save</button>
                        </div>
                        <div class="col-md-9 text-right">
                            <button type="button" id="clear_button" class="btn btn-warning">Clear</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('JScript')
    <script type="text/javascript" src="{{ asset('assets/js/page-js/teacher/teacher.js')}}"></script>
@endsection
