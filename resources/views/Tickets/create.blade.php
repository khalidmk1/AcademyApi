@extends('Layouts.master')

@section('content')
    @include('Tickets.Components.modelCreate')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestion Tickets</h1>
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

            <div class="row">
                <div class="col-12 mb-2">
                    <button class="btn btn-block btn-default w-25" data-toggle="modal" data-target="#staticBackdrop"
                        style="float: right">Crée</button>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Table de Ticket</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr  class="text-center">
                                        <th>Type</th>
                                        <th>Date Création</th>
                                        <th>Utilisateur</th>
                                        <th>Statu</th>
                                        <th>Derniere Modifier</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->Type_Ticket }}</td>
                                            <td>{{ \Carbon\Carbon::parse( $ticket->created_at)->format('d/m/Y')  }}</td>
                                            <td>{{ $ticket->user->firstName . ' ' . $ticket->user->lastName }}</td>
                                            <td><span
                                                    class="tag tag-success">{{ $ticket->status == 1 ? 'traité' : 'Encours' }}
                                                    <a href="{{Route('dashboard.tickets.edite' , Crypt::encrypt($ticket->id))}}">
                                                        <i class="fa fa-plus mt-1" aria-hidden="true"
                                                        style="cursor: pointer ; float: right;"></i>
                                                    </a>
                                                </span></td>
                                            <td>{{ $ticket->manageruser->email }}</td>
                                            <td>{{ \Carbon\Carbon::parse( $ticket->updated_at)->format('d/m/Y') }}</td>
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
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();
            $('.select3').select2();


            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })
    </script>
@endsection
