@extends('Layouts.master_empty')

@section('content')
    @include('Layouts.errorshandler')
    {{-- <div class="card w-75 mb-3">
        <div class="card-body">
            <h5 class="card-title">Merci pour l'enregistrement! Avant de commencer, pourriez-vous vérifier votre adresse
                e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu
                l'e-mail, nous vous en enverrons volontiers un autre.</h5>

            <div class="row">
                <div class="col">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button type="submit" class="btn btn-outline-primary">
                                Renvoyer l'e-mail de vérification
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-outline-danger">
                            Se déconnecter
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div> --}}

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <p class="login-box-msg">Merci pour l'enregistrement! Avant de commencer, pourriez-vous vérifier votre adresse
                e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu
                l'e-mail, nous vous en enverrons volontiers un autre.</p>
            <div class="card-body row">

                <form method="POST" class="col-8" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">
                        Renvoyer l'e-mail de vérification
                    </button>

                </form>

                <div class="col-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-outline-danger">
                            Se déconnecter
                        </button>
                    </form>
                </div>
                <!-- /.col -->

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection
