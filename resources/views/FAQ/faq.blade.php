@extends('Layouts.master')


@section('content')
    @include('FAQ.create.Modelcreate')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FAQ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('Layouts.errorshandler')
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Crée FAQ</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <a data-toggle="modal" data-target="#staticBackdrop" class="btn btn-block btn-default w-25">
                                Crée
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        @foreach ($FAQs as $FAQ)
                            <form action="{{ Route('dashboard.FAQ.update', Crypt::encrypt($FAQ->id)) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group row">
                                        <label for="Question" class="col-md-1 col-form-label">Question</label>
                                        <div class="col-md-6">
                                            <!-- select -->
                                            <input type="text" value="{{ old('question', $FAQ->question) }}"
                                                class="form-control" name="Question" id="Question"
                                                placeholder="Entrez Nom ...">
                                        </div>

                                        <div class="col-md-5">
                                            <button type="submit" class="btn btn-block btn-warning w-25 mb-3 ml-3"
                                                style="float: right">
                                                Modifier</button>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Réponse </label>
                                        <textarea class="form-control" name="answer" rows="3" placeholder="Enter ...">{{ $FAQ->answer }}</textarea>
                                    </div>
                                </div>
                                <hr style="background: white">

                            </form>
                        @endforeach

                    </div>





                </div>
            </div>
        </div>

    </section>
@endsection
