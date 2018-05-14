@extends('layouts.app')

@section('title', 'Admin - Users List')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Users List</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown" id="users-list">
        <div class="row">
            <div class="col-lg-12">
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
                        @include('admin.partials.usersListFilters')
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>List of users and theirs roles</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="users-table">
                                <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th class="col-actions"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="users-first-name"></td>
                                    <td class="users-last-name"></td>
                                    <td class="users-email"></td>
                                    <td class="users-roles"></td>
                                    <td class="users-actions"></td>
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
    <div class="modal fade inmodal" id="view_user" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">User Information</h4>
                </div>
                <div class="view-user-body">
                </div>
            </div>
        </div>
    </div>
@endsection