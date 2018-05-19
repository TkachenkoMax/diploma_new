@extends('layouts.app')

@section('title', 'Contacts - Management')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Contacts management</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown" id="user-settings">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Search and add new contacts</h5>
                    </div>
                    <div class="ibox-content" style="min-height: 300px">
                        <div class="row">
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover text-center">
                                        <thead>
                                        <tr class="text-center">
                                            <th>Photo</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th class="col-actions">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($incomingContacts as $contact)
                                                <tr>
                                                    <td width="20%"><img alt="image" class="img-circle" style="width: 50px;" src="{{ $contact->getAvatarUrl() }}"></td>
                                                    <td width="30%" class="align-middle">{{ $contact->getFullName() }}</td>
                                                    <td width="35%" class="align-middle">{{ $contact->email }}</td>
                                                    <td width="15%" class="align-middle">
                                                        <div>
                                                            <i class="fas fa-check-circle color-green-hover cursor-pointer"></i>
                                                            <i class="fas fa-times-circle color-red-hover cursor-pointer"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Outcoming requests</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th class="col-actions">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($outcomingContacts as $contact)
                                            <tr>
                                                <td width="20%"><img alt="image" class="img-circle" style="width: 50px;" src="{{ $contact->getAvatarUrl() }}"></td>
                                                <td width="30%" class="align-middle">{{ $contact->getFullName() }}</td>
                                                <td width="35%" class="align-middle">{{ $contact->email }}</td>
                                                <td width="15%" class="align-middle">
                                                    <div>
                                                        <i class="fas fa-times-circle color-red-hover cursor-pointer"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
        </div>
    </div>
    @include('settings.modals.updatePictureModal')
@endsection
