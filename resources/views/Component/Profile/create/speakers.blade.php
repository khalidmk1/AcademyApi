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
                    <h1>Manage Speaker Page</h1>
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
                            <h3 class="card-title">Crée Speaker</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <a href="{{ Route('dashboard.speaker.view') }}" class="btn btn-block btn-default w-25">
                                Voir Les Speakers
                            </a>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <form action="{{ Route('dashboard.speaker.store') }}" method="post">
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
                                <label>Speaker biographie</label>
                                <textarea class="form-control" name="biographie" rows="3" placeholder="Entrez biographie ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Type de Speaker</label>
                                <select name="type_speaker" class="form-control select2" style="width: 100%;">
                                    <option value="Animateur">Animateur</option>
                                    <option value="Formateur">Formateur</option>
                                    <option value="Invité">Invité</option>
                                    <option value="Modérateur">Modérateur</option>
                                    <option value="Conférencier">Conférencier</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                                    id="exampleInputEmail1" placeholder="Entrez email ...">
                            </div>


                        </div>

                        <button type="submit" class="btn btn-block btn-info w-25  mb-3 ml-3" style="float: right">Crée Speaker</button>

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
