@extends('Layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mettre à jour votre profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mettre à jour Mots de Passe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('dashboard.password.update') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputPassword1"> Mot de passe actuel</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Enter Mots de Passe" name="current_password">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nouveaux Mots de Passe</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Enter Mots de Passe" name="password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">confirmé Mots de Passe</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Enter confirmé Mots de Passe" name="password_confirmation">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>

                    </div>
                </form>

            </div>
        </div>
    </div>



    @include('Layouts.errorshandler')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid ">
            <div class="row ">
                <!-- left column -->
                <div class="col-md-8 m-auto">
                    <!-- general form elements -->
                    <div class="card card-primary card-outline">

                        <!-- form start -->
                        <form action="{{ Route('dashboard.profile.update', Crypt::encrypt($user->id)) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="firstName"> Nom</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName"
                                        value="{{ old('firstName', $user->firstName) }}">

                                </div>
                                <div class="form-group">
                                    <label for="lastName">Prénom</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName"
                                        value="{{ old('lastName', $user->lastName) }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                        value="{{ old('email', $user->email) }}">
                                </div>

                                @if ($user->userRole->role_id == 3)
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label for="biographie">Biographie</label>
                                        <textarea class="form-control" id="biographie"  rows="3" name="biographie" placeholder="Enter ...">{{$user->userspeaker->biographie}}</textarea>
                                    </div>
                                @endif

                            </div>
                            <!-- /.card-body -->


                            <div class="card-footer">
                                <button type="submit" class="btn btn-block btn-warning w-25" style="float: right">Mettre à jour</button>
                                @if (auth()->user()->id == $user->id)
                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                        class="btn btn-primary">Change Mots de Passe</button>
                                @endif
                            </div>


                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
