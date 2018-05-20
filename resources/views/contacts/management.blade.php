@extends('layouts.app')

@section('title', 'Contacts - Management')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Contacts management</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown" id="users-management">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Search and add new contacts</h5>
                    </div>
                    <div class="ibox-content" style="min-height: 300px">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label small">Name</label>
                                <input name="filter_name" type="text" class="form-control" id="filter-by-name" placeholder="Enter part of fullname..."/>
                            </div>
                        </div>
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover text-center hidden" id="users-search">
                                <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Fullname</th>
                                    <th>Date of Birth</th>
                                    <th>Work</th>
                                    <th class="col-actions"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="users-photo"></td>
                                    <td class="users-fullname"></td>
                                    <td class="users-birthday"></td>
                                    <td class="users-work"></td>
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
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Incoming an outcoming requests</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="min-height: 300px">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>Incoming requests</h5>
                                @if(count($incomingContacts))
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Photo</th>
                                                    <th width="30%">Fullname</th>
                                                    <th width="35%">Email</th>
                                                    <th width="15%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($incomingContacts as $contact)
                                                    <tr data-user-id="{{ $contact->id }}">
                                                        <td width="20%"><img alt="image" class="img-circle" style="width: 50px;" src="{{ $contact->getAvatarUrl() }}"></td>
                                                        <td width="30%" class="align-middle">{{ $contact->getFullName() }}</td>
                                                        <td width="35%" class="align-middle">{{ $contact->email }}</td>
                                                        <td width="15%" class="align-middle">
                                                            <div>
                                                                <i class="fas fa-check-circle fa-lg color-green-hover cursor-pointer accept-request" data-user-id="{{ $contact->id }}"></i>
                                                                <i class="fas fa-times-circle fa-lg color-red-hover cursor-pointer decline-request" data-user-id="{{ $contact->id }}"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </div>
                                @else
                                    <p>No incoming requests now...</p>
                                @endif
                            </div>
                            <div class="col-lg-12">
                                <h5>Outcoming requests</h5>
                                @if(count($outcomingContacts))
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Photo</th>
                                                    <th width="30%">Fullname</th>
                                                    <th width="35%">Email</th>
                                                    <th width="15%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($outcomingContacts as $contact)
                                                <tr data-user-id="{{ $contact->id }}">
                                                    <td width="20%"><img alt="image" class="img-circle" style="width: 50px;" src="{{ $contact->getAvatarUrl() }}"></td>
                                                    <td width="30%" class="align-middle">{{ $contact->getFullName() }}</td>
                                                    <td width="35%" class="align-middle">{{ $contact->email }}</td>
                                                    <td width="15%" class="align-middle">
                                                        <div>
                                                            <i class="fas fa-times-circle fa-lg color-red-hover cursor-pointer decline-request" data-user-id="{{ $contact->id }}"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </div>
                                @else
                                    <p>No outcoming requests now...</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('settings.modals.updatePictureModal')
@endsection
