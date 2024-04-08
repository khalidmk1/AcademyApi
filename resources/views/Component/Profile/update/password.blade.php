@extends('Layouts.master_empty')

@section('content')

@include('Layouts.errorshandler')

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">vous ne pouvez pas accéder à votre backoffice donc vous changez vos mots de passe</p>

            <form action="{{ Route('password-change.update') }}" method="post">
                @csrf
                @method('patch')


                <div class="form-group">
                    <label for="exampleInputPassword1"> Mot de passe actuel</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Mots de Passe"
                        name="current_password">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Nouveaux Mots de Passe</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Mots de Passe"
                        name="password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">confirmé Mots de Passe</label>
                    <input type="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Enter confirmé Mots de Passe" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary">Change mots de passe</button>
            </form>


        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
@endsection
