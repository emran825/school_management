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
                            <span class="d-inline-block"> Notice </span>
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
                    <button type="button" onclick='noticeAdd()' title="Add new Notice" data-placement="bottom" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-plus"></i>
                        Add New Notice
                    </button>
                     @endif
                </div>
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table class="table table-bordered table-hover notice_table" id="notice_table" style="width:100% !important">
                    <thead>
                        <tr>
                            <th width="">Title</th>
                            <th width="">Category</th>
                            <th width="">Notice Date</th>
                            <th width="">Expire Date</th>
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
                <h5 class="modal-title title" id="form-title"><i class="fa fa-plus"></i> Add Notice Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="notice_form" autocomplete="off" name="notice_form" enctype="multipart/form-data" class="form form-horizontal form-label-left">
                            @csrf
                            <input type="hidden" name="edit_id" id="edit_id">
                            <div class="form-group">
                                <label for="title">Notice Title</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="subject_name" placeholder="Enter Notice Title">
                            </div>
                            <div class="form-group">
                                <label for="subject_name">Notice Type</label>
                                <select class="form-control" name="notice_category_id" id="notice_category_id">
                                    <option selected value="">Select Notice Type</option>
                                    @foreach ($noticeCategories as $noticeCategory)
                                    <option value="{{ $noticeCategory->id }}"> {{ $noticeCategory->category_name }}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="subject_details">Details</label>
                                <textarea class="form-control"name="details" id="details" rows="2"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputEmail4">Notice Date</label>
                                  <input type="text" class="form-control"  id="notice_date" name="notice_date">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="inputPassword4">Expire Date</label>
                                  <input type="text" id="expire_date" name="expire_date" class="form-control" >
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Attachment</span>
                                </div>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="attachment" name="attachment">
                                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                              </div>
                              <div class="attached-file"></div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-6" >Is Active</label>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <input type="checkbox" id="status" name="status" checked="checked" value="1" class="form-control " />
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
                        <button type="submit" id="save_notice" class="btn btn-success  btn-lg btn-block">Save</button>
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
<script src="{{ asset('assets/js/page-js/notification&notice/notice.js')}}"></script>
@endsection

