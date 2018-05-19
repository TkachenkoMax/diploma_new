@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Contacts</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown" id="user-contacts">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>List of your contacts</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            @foreach($contacts as $contact)
                                <div class="col-lg-4 contact-container" data-user-id="{{ $contact->id }}">
                                    <div class="contact-box contact-wrap">
                                        <div class="col-lg-5">
                                            <div class="text-center">
                                                <img alt="image" class="img-circle img-responsive" src="{{ $contact->getAvatarUrl() }}">
                                                <div class="m-t-xs font-bold">{{ $contact->work_position ?: 'Work not specified' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 text-center">
                                            <h3><strong>{{ $contact->getFullName() }} @if(isset($contact->sex))({{ $contact->getSex() }})@endif</strong></h3>
                                            <p>Date of birth: {{ $contact->date_of_birth ? \Illuminate\Support\Carbon::parse($contact->date_of_birth)->toFormattedDateString() : 'Not specified' }}</p>
                                            <p>Work place: {{ $contact->work_place ?: 'Not specified' }}</p>
                                            <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                                            <p><i class="fa fa-map-marker"></i> {{ $contact->address ?: 'Address not specified' }}</p>
                                            <abbr title="Phone">P:</abbr> {{ $contact->phone_number ?: '—' }}
                                        </div>
                                        <span class="contact-delete" data-user-id="{{ $contact->id }}"><i class="fas fa-times-circle fa-lg cursor-pointer color-red-hover"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('settings.modals.updatePictureModal')
@endsection
