@extends('Layouts.master')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crée des Roles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('dashboard.roles.store') }}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Titre</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                placeholder="Entrez titre">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Entrez description ..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-block btn-info w-25">Crée</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            @if (session('status'))
                <div class="alert  alert-success alert-dismissible fade show ml-1" role="alert">
                    <i class="icon fas fa-check"></i> {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button class="btn btn-block btn-default" data-toggle="modal"
                                    data-target="#exampleModal">Crée Role</button>
                            </h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" id="search_role" name="role"
                                        class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 440px;" >
                            <table class="table table-head-fixed text-nowrap" id="searchedRole">
                                <thead>
                                    <tr>
                                        <th class="text-center">Roles</th>

                                        @foreach ($role_permissions['permissions'] as $permission)
                                            <th class="text-center">{{ $permission->permission_name }}</th>
                                        @endforeach

                                    </tr>
                                </thead>
                                <tbody id="searchedRole">
                                    @foreach ($role_permissions['roles'] as $role)
                                        <tr class="text-center">
                                            <td>{{ $role->role_name }}</td>
                                            @foreach ($role_permissions['permissions'] as $permission)
                                                {{-- Check if the role has the permission --}}
                                                <td class="text-center">
                                                    <form>
                                                        @csrf
                                                        <div class="icheck-primary d-inline">

                                                            <input type="checkbox" class="checkbox make_permission"
                                                                data-role = "{{ $role->id }}" {!! $role->id == 1 || $role->role_name == 'Admin' ? 'disabled' : '' !!}
                                                                {{ isset($role_permissions['RolePermissioncheck'][$role->id]) &&
                                                                $role_permissions['RolePermissioncheck'][$role->id]->contains('permission_id', $permission->id) &&
                                                                $role_permissions['RolePermissioncheck'][$role->id]->contains('confirmed', 1)
                                                                    ? 'checked'
                                                                    : '' }}
                                                                data-permission="{{ $permission->id }}"
                                                                id="checkboxPrimary_{{ $permission->id }}_{{ $role->id }}">
                                                            <label
                                                                for="checkboxPrimary_{{ $permission->id }}_{{ $role->id }}">
                                                            </label>

                                                        </div>
                                                    </form>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

        </div>
    </section>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $(".make_permission").change(function(e) {
                e.preventDefault()

                var role_id = $(this).attr("data-role");
                var permission_id = $(this).attr("data-permission");
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '/backoffice/role-permission/' + role_id + '/' + permission_id,
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    success: function(response) {
                        console.log(response);

                    },
                    error: function(error) {
                        console.log(error);
                    }

                })

            });


            $("#search_role").on('keyup', function(e) {

                e.preventDefault()
                var search_role = $(this).val();

                
                $.ajax({
                    url: '/backoffice/search/role', 
                    method: 'GET',
                    data: {
                        role: search_role
                    },
                    success: function(response) {
                        console.log(response);

                        $('#searchedRole tbody').empty();
                        $('#searchedRole tbody').append(response.output)
                       
                       
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });


        })
    </script>
@endsection
