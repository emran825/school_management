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
                            <span class="d-inline-block"> Subjects </span>
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
                    {{-- @if($actions['add_permission']>0)--}}
                    <button type="button" onclick='SubjectAdd()' title="Add new Subject" data-placement="bottom" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-plus"></i>
                        Add New Subject
                    </button>
                    {{-- @endif--}}
                </div>
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table class="table table-bordered table-hover subject_table" id="subject_table" style="width:100% !important">
                    <thead>
                        <tr>
                            <th width="">Name</th>
                            <th width="">Details</th>
                            <th class="hidden-xs" width="10%">Status</th>
                            <th width="80">Actions</th>
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
<div class="modal fade" id="entry-form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title" id="form-title"><i class="fa fa-plus"></i> Add New Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="subject_form" autocomplete="off" name="subject_form" enctype="multipart/form-data" class="form form-horizontal form-label-left">
                            @csrf
                            <input type="hidden" name="edit_id" id="edit_id">
                            <div class="form-group">
                                <label for="subject_name">Subject Name</label>
                                <input type="text" class="form-control" id="subject_name" name="subject_name" aria-describedby="subject_name" placeholder="Enter Subject Name">
                            </div>
                            <div class="form-group">
                                <label for="subject_details">Details</label>
                                <textarea class="form-control" id="subject_details" name="subject_details" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="subject_name">Is Active</label>
                                <input type="checkbox" id="status" name="status" checked="checked" value="1" class="form-control col-lg-12" />
                            </div>
                            <hr>
                            <div class="form-row bg-gray ">
                                <div class="col-md-4"><b>Subject Topic Details</b></div><br>
                                <div class="col-md-8 text-right">
                                </div>
                                <br>
                                <br>
                                <table class="table table-bordered table-striped topic_table " id="tb" style="width: 100%">
                                    <tbody id="emp_details">
                                        <tr>
                                            <th style="width: 20%">Topic Name</th>
                                            <th style="width: 45%">Details </th>
                                            <th style="width: 25%">Status </th>
                                            <th style="width: 25%">
                                                <button type="button" class="add-row btn btn-info"><i class="fa fa-plus"></i></button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
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
                        <button type="submit" id="save_subject" class="btn btn-success  btn-lg btn-block">Save</button>
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
<script src="{{ asset('assets/js/page-js/subject/subject.js')}}"></script>
@endsection

