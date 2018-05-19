<div class="col-sm-4">
    <div class="text-center">
        <div class="img-wrap m-t-xs">
            <img alt="image" class="img-circle img-responsive img-responsive-50 cursor-pointer"
                 src="{{ $user->getAvatarUrl() }}" id="profile_picture">
            @if($user->getLastAvatar())<div class="overlay"><span id="delete_photo">Delete</span></div>@endif
        </div>
        <div class="m-t-xs font-bold">{{ $user->work_position ?: 'Work not specified' }}</div>
    </div>
</div>
<div class="col-sm-8 text-xs-center">
    <h3><strong>{{ $user->getFullName() }} @if(isset($user->sex))({{ $user->getSex() }})@endif</strong></h3>
    <p>Date of birth: {{ $user->date_of_birth ? \Illuminate\Support\Carbon::parse($user->date_of_birth)->toFormattedDateString() : 'Not specified' }}</p>
    <p>Work place: {{ $user->work_place ?: 'Not specified' }}</p>
    <p><i class="fa fa-map-marker"></i> {{ $user->address ?: 'Address not specified' }}</p>
    <abbr title="Phone">P:</abbr> {{ $user->phone_number ?: '—' }}
</div>