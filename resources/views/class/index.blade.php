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
                                    <span class="d-inline-block">Classes</span>
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

                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <table class="table table-bordered table-hover class_table" id="class_table" style="width:100% !important">
                                    <thead>
                                    <tr>
                                        <th>Academic Years</th>
                                        <th>Key Stage</th>
                                        <th>Class</th>
                                        <th>Details </th>
                                        <th width='90' class="text-center">Actions</th>
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
                    <form id="subject_class_form" autocomplete="off" name="subject_class_form" enctype="multipart/form-data" class="form form-horizontal form-label-left">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative form-group student_id_no" >
                                                            <label for="key_stage_name" class="">Key Stage<span class="required">*</span></label>
                                                            <input class="form-control" type="text" id="key_stage_name" name="key_stage_name" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative form-group student_id_no" >
                                                            <label for="class_name" class="">Class<span class="required">*</span></label>
                                                            <input class="form-control" type="text" id="class_name" name="class_name" readonly>
                                                            <input class="form-control" type="hidden" id="class_id" name="class_id">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-row">
                                                            <div class="col-md-12 "><b> Search and add Subjects for this Class</b></div>
                                                        </div>
                                                        <div class="form-row ">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-6" ></label>
                                                            <div class="col-md-12 well">
                                                                <input type="text" id="subject_name" name="subject_name" autocomplete="off" placeholder="Search Subject name" class="form-control col-lg-12 bordered" />
                                                                </br>
                                                                <div class='' id="unit_list_table">
                                                                    <table class="table table-bordered table-hover subject_table" id="subject_table" style="width:100% !important">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Details</th>
                                                                            <th width="50px"></th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="tbody">
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                       <button type="submit" id="save_class_subject" class="btn btn-success  btn-lg btn-block">Save</button>
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
    <script type="text/javascript" src="{{ asset('assets/js/page-js/class/class.js')}}"></script>
@endsection
