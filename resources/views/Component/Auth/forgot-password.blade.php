@extends('Layouts.master_empty')

@section('content')
    <div id="ajax-errors-container"></div>

    <div id="success">

    </div>

    {{-- @if (session('status'))
        <p class="text-success">{{ session('status') }}</p>
    @endif --}}
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Vous avez oublié votre mot de passe ? Ici, vous pouvez facilement récupérer un nouveau
                mot de passe.</p>

            <form id="forget_password" action="{{ Route('password.email') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Demander un nouveau mot de passe</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{ Route('login.create') }}">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#forget_password').submit(function(e) {
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
                            var success = `
    <div class="alert  alert-success alert-dismissible fade show ml-1 w-100" role="alert">
        <i class="icon fas fa-exclamation-triangle"></i> ${response.status}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
`;

                            $('#success').html(success)

                            console.log(response);

                        },
                        error: function(error) {

                            console.log(error);

                            // Clear previous errors
                            $('#ajax-errors-container').empty();

                            // Append new errors to the container
                            if (error.responseJSON || error.responseJSON.errors) {
                                var errors = error.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#ajax-errors-container').append(
                                        '<div class="alert  alert-warning alert-dismissible fade show ml-1" role="alert"><i class="icon fas fa-exclamation-triangle"></i>  ' +
                                        value +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                    );
                                });
                            }


                        }

                    })
                }

            )
        })
    </script>
@endsection
