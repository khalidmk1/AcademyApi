@foreach ($rolesUser as $roleuser)
    @include('Component.Profile.delete.searchDelete')
    <div class=" mb-2 p-3 col-4">
        <div class="card bg-light p-4">
            <div class=" image d-flex flex-column justify-content-center align-items-center">
                <img class="rounded mx-auto d-block" src="../../dist/img/user1-128x128.jpg" alt="user-avatar" height="100"
                    width="100" />
                <div class="text mt-3">
                    <strong></strong>
                </div>
                <span class="name mt-3">{{$roleuser->user->firstName . ' '.$roleuser->user->lastName }}</span> 
                <span class="idd">{{ $roleuser->user->email }}</span>
                <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                    <span class="idd1">{{$roleuser->user->userspeaker->biographie}}</span>
                </div>

                <div class="text-right  mt-3">
                    <a href="{{ Route('dashboard.profile.edit', Crypt::encrypt($roleuser->user->id)) }}"
                        class="btn btn-sm bg-warning mr-3">
                        <img src="{{ asset('asset/update_icon.png') }}" style="height: 18px;" alt="update_icon">
                    </a>
                    <button type="button" data-toggle="modal" style="float: right"
                        data-target="#delete_admin_{{ $roleuser->user->id }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
@endforeach
