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
                                <span class="d-inline-block">Schools</span>
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
                        <button type="button" onclick='addSchool()' title="Add a new School" data-placement="bottom" class="btn-shadow mr-3 btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Add New School
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <table class="table table-bordered table-hover learners_table" id="schools_table" style="width:100% !important">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Register Date </th>
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
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="entry-form" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form-title"><i class="fa fa-plus"></i> Add  New School</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form id="school_form" autocomplete="off" name="school_form" enctype="multipart/form-data" class="form form-horizontal form-label-left">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="name" class="">School Name<span class="required">*</span></label>
                                                    <input type="text" id="name" name="name"  class="form-control col-lg-12"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="email" class="">Email<span class="required">*</span></label>
                                                    <input type="email" id="email" name="email" required class="form-control col-lg-12"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label for="address" class="">Address</label>
                                                    <textarea id="address" name="address"  class="form-control col-lg-12"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label for="address" class="">Contact No<span class="required">*</span></label>
                                                    <input type="text" id="contact_no" name="contact_no" required class="form-control col-lg-12"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label>Principle Name<span class="required">*</span></label>
                                                    <input type="text" id="principle_name" name="principle_name" required class="form-control col-lg-12"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label> Principle Contact No </label>
                                                    <input type="text" id="principle_contact_no" name="principle_contact_no" class="form-control col-lg-12"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label>Reference Person<span class="required">*</span></label>
                                                    <input type="text" id="reference_person" name="reference_person" required class="form-control col-lg-12"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label>Reference Contact No <span class="required">*</span></label>
                                                    <input type="text" id="reference_contact_no" name="reference_contact_no" required class="form-control col-lg-12"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label>Registration Date<span class="required">*</span></label>
                                                    <input type="date" id="registration_date" name="registration_date" class="form-control col-lg-12"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label>Valid Till</label>
                                                    <input type="date" id="valid_till" name="valid_till" required class="form-control col-lg-12"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label>Remarks</label>
                                                    <textarea rows="2" cols="100" id="remarks" name="remarks" class="form-control col-lg-12"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label>Is Active</label>
                                                    <input type="checkbox" id="is_active" name="is_active" checked="checked" value="1" class="form-control col-lg-12"/>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12" style="display: flex; flex-direction: row;">
                        <div class="col-md-3 text-left">
                            <button type="submit" id="save_school" class="btn btn-success  btn-lg btn-block">Save</button>
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
    <script type="text/javascript" src="{{ asset('assets/js/page-js/school/school.js')}}"></script>
@endsection

