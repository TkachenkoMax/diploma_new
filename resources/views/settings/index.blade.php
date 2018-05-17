@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Settings</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown" id="users-settings">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Your profile</h5>
                    </div>
                    <div class="ibox-content" style="min-height: 210px">
                        <div class="row">
                           @include('settings.partials.userInformation')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Change password</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="min-height: 210px">
                        <div class="row">
                            @include('settings.partials.changePassword')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Change information</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            @include('settings.partials.changeInformation')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('settings.modals.updatePictureModal')
@endsection
