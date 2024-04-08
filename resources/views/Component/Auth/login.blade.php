@extends('Layouts.master_empty')

@section('content')

@include('Layouts.errorshandler')

    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="" class="h1"><b>Admin</b>LTE</a>

        </div>
        <div class="card-body">
            <p class="login-box-msg">Connectez-vous pour démarrer votre session</p>

            <form action="{{ Route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
                    <div class="input-group-append" >
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Souviens-toi de moi
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <p class="mb-1">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">j'ai oublié mon mot de passe</a>
                @endif

            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

     {{-- <script>
        $(document).ready(function() {
            $('#login').submit(function(e) {
                    e.preventDefault()
                    var formData = new FormData(this);
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: formData,
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
                }

            )
        })
    </script> --}}
@endsection
