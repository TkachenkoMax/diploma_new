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
                            <div class="col-sm-4">
                                <div class="text-center">
                                    <img alt="image" class="img-circle m-t-xs img-responsive img-responsive-50 cursor-pointer"
                                         src="https://png.icons8.com/color/1600/user-male-skin-type-4.png">
                                    <div class="m-t-xs font-bold">{{ $user->work_position ?: 'Work not specified' }}</div>
                                </div>
                            </div>
                            <div class="col-sm-8 text-xs-center">
                                <h3><strong>{{ $user->getFullName() }}</strong></h3>
                                <p>Work place: {{ $user->work_place ?: 'Not specified' }}</p>
                                <p><i class="fa fa-map-marker"></i> {{ $user->address ?: 'Address not specified' }}</p>
                                <abbr title="Phone">P:</abbr> {{ $user->phone_number ?: '—' }}
                            </div>
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
                        <h3>Change information</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
