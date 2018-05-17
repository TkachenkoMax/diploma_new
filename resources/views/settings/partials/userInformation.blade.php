<div class="col-sm-4">
    <div class="text-center">
        <img alt="image" class="img-circle m-t-xs img-responsive img-responsive-50 cursor-pointer"
             src="https://png.icons8.com/color/1600/user-male-skin-type-4.png">
        <div class="m-t-xs font-bold">{{ $user->work_position ?: 'Work not specified' }}</div>
    </div>
</div>
<div class="col-sm-8 text-xs-center">
    <h3><strong>{{ $user->getFullName() }} @if(isset($user->sex))({{ $user->getSex() }})@endif</strong></h3>
    <p>Work place: {{ $user->work_place ?: 'Not specified' }}</p>
    <p><i class="fa fa-map-marker"></i> {{ $user->address ?: 'Address not specified' }}</p>
    <abbr title="Phone">P:</abbr> {{ $user->phone_number ?: '—' }}
</div>