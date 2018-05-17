<div class="modal-body" style="overflow:hidden;">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive"
                                 src="https://png.icons8.com/color/1600/user-male-skin-type-4.png">
                            <div class="m-t-xs font-bold">{{ $user->work_position ?: 'Work not specified' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>{{ $user->getFullName() }} @if(isset($user->sex))({{ $user->getSex() }})@endif</strong></h3>
                        <p>Work place: {{ $user->work_place ?: 'Not specified' }}</p>
                        <p><i class="fa fa-map-marker"></i> {{ $user->address ?: 'Address not specified' }}</p>
                        <abbr title="Phone">P:</abbr> {{ $user->phone_number ?: '—' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    {!! Form::open(['id' => 'user_roles_edit', 'class'=> 'form-horizontal', 'method' => 'post', 'url' => route('user.roles.update', ['id' => $user->id])]) !!}
                    <div class="col-sm-8">
                        <div >
                            <label class="small">Roles</label>
                            {!! Form::select('roles', $roles, $user->roles->pluck('id'),
                            ['id' => 'user_roles', 'class' => 'form-control full-width', 'multiple']) !!}
                        </div>
                    </div>
                    <div class="col-sm-4 m-t-md">
                        <button class="btn btn-primary" id="save_roles" type="submit">Save</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>