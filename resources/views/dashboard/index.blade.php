@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Dashboard</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown" id="dashboard">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins" id="filters">
                    <div class="ibox-title">
                        <h5>Filters</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                       @include('dashboard.partials.dashboardFilters')
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <h4>Hello, {{ Auth::user()->getFullName() }}!</h4>
                        <p>Today is {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Your calendars and events</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
