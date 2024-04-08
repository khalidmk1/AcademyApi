@extends('Layouts.master')

@section('content')
    <style>
        .bootstrap-tagsinput {
            border: #00000029 solid 2px;
            padding: 4px;
            border-radius: 3px;

        }

        .bootstrap-tagsinput:first-child {
            border: none,

        }

        .bootstrap-tagsinput .tag {
            background: rgb(163, 159, 154);
            padding: 4px;
            font-size: 14px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            color: black
        }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manger Programme</h1>
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


    <!-- Modal Create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crée Programme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('dashboard.program.store') }}" method="post">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="title"> Titre</label>
                            <input value="{{ old('title') }}" type="text" class="form-control" id="title"
                                placeholder="Enter Nom de Categorie ..." name="title">
                        </div>

                        <div class="form-group">
                            <label for="Description"> Description</label>
                            <textarea class="form-control" id="Description" name="Description" rows="3" placeholder="Entrez Description ..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tags">Mots Clé</label>
                            <input type="text" class="form-control" name="tags[]" id="tags-input" />
                        </div>

                        <div class="form-group">
                            <label>Categories</label>
                            <select class="select2" multiple="multiple" name="categories[]"
                                data-placeholder="Select a State" style="width: 100%;">
                                @foreach ($categories_programs['categories'] as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <!-- /.form-group -->

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Crée</button>
                    </div>

                </form>



            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <button type="button" data-toggle="modal" data-target="#exampleModal"
                                    class="btn btn-block btn-primary w-25 position-absolute" style="z-index: 1000">
                                    Crée des Programme
                                </button>
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Mots Clé</th>
                                        <th>Categories</th>
                                        <th>Modifier</th>
                                        <th>Suprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories_programs['programs'] as $program)
                                        @include('filtering.update.program')
                                        @include('filtering.delete.program')

                                        <tr class="text-center">
                                            <td>{{ $program->title }}</td>
                                            <td>{!! Str::words($program->description, 10,'....')  !!}
                                                </td>
                                            <td>

                                                @php
                                                    $tags = $program->tags;
                                                    foreach ($tags as $key => $tag) {
                                                        $parts = explode(',', $tag);
                                                    }

                                                @endphp
                                                <h5>
                                                    @foreach ($parts as $part)
                                                        <span class="badge badge-secondary">
                                                            {{ $part }}
                                                        </span>
                                                    @endforeach
                                                </h5>

                                            </td>
                                            <td>
                                                <h5>
                                                    @foreach ($program->categories as $category)
                                                        <span class="badge badge-secondary">
                                                            {{ $category }}
                                                        </span>
                                                    @endforeach
                                                </h5>
                                            </td>
                                            <td><a type="button" data-toggle="modal"
                                                    data-target="#update_program_model_{{ $program->id }}"
                                                    class="btn btn-sm bg-warning">
                                                    <img src="{{ asset('asset/update_icon.png') }}" style="height: 18px;"
                                                        alt="update_icon">
                                                </a></td>
                                            <td> <button type="button" data-toggle="modal" data-target="#delete_program_{{$program->id}}" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button></td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


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


            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        })

        $(document).ready(function() {
            var tagInputEle = $('#tags-input');
            tagInputEle.tagsinput();

            
        });
    </script>
@endsection
