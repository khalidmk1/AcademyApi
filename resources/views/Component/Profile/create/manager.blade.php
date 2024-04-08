@extends('Layouts.master')

@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            height: 40px !important;
        }
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mange Manager Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    @include('Layouts.errorshandler')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-default col-12">


                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Crée Manager</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <a href="{{ Route('dashboard.manager.view') }}" class="btn btn-block btn-default w-25">
                                Voir Les Managers
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ Route('dashboard.manager.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="firstName">Prénom</label>
                                <input type="text" value="{{ old('firstName') }}" class="form-control" name="firstName"
                                    id="firstName" placeholder="Entrez Prénom ...">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Nom</label>
                                <input type="text" value="{{ old('lastName') }}" class="form-control" name="lastName"
                                    id="lastName" placeholder="Entrez Nom ...">
                            </div>

                            <div class="form-group">
                                <label>Roles</label>
                                <select name="role_id" class="form-control select2" style="width: 100%;">
                                    @foreach ($roles['roles'] as $role)
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                                    id="exampleInputEmail1" placeholder="Entrez email ...">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Mots de Passe</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Entrez Mots de Passe ...">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirme Mots de Passe</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" placeholder="Entrez Confirme Mots de Passe ...">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3" style="float: right">Crée Manger</button>

                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
