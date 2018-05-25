@extends('layouts.app')

@section('title', 'Calendars - Management')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Calendars management</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown" id="calendars-list">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Search and add new calendars</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label small">Calendar name</label>
                                <input name="filter_name" type="text" class="form-control" id="filter-by-name" placeholder="Enter part of calendar name..."/>
                            </div>
                        </div>
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover text-center" id="calendars-search">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Creator</th>
                                    <th class="col-actions"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="calendar-id"></td>
                                    <td class="calendar-name"></td>
                                    <td class="calendar-description"></td>
                                    <td class="calendar-creator"></td>
                                    <td class="calendar-actions"></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Search & Filters</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" id="filters">
                        @include('dashboard.partials.calendarsListFilters')
                    </div>
                </div>
                <div class="ibox-tools pull-right m-b-md">
                    <a href="" id="create_new_calendar">
                        <button type="button" class="btn btn-primary btn-xs"><i class="fa fa-lg fa-plus-circle"></i> Create Calendar</button>
                    </a>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>List of your calendars</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover text-center" id="calendars-list">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Creator</th>
                                    <th>Is public</th>
                                    <th>Is editable</th>
                                    <th class="col-actions"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="calendar-id"></td>
                                    <td class="calendar-name"></td>
                                    <td class="calendar-description"></td>
                                    <td class="calendar-creator"></td>
                                    <td class="calendar-is-visible"></td>
                                    <td class="calendar-is-editable"></td>
                                    <td class="calendar-actions"></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade inmodal" id="create_calendar" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Create new calendar</h4>
                </div>
                <div class="create-calendar-body">
                    @include('dashboard.modals.calendarBody')
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade inmodal" id="update_calendar" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Update calendar</h4>
                </div>
                <div class="update-calendar-body">
                </div>
            </div>
        </div>
    </div>
@endsection