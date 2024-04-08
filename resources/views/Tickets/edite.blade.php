@extends('Layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Tickets</h1>
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
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <form action="{{ Route('dashboard.tickets.update', Crypt::encrypt($ticket->id)) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="card-header row justify-content-between">
                        <div class="col-6">
                            <h3 class="card-title">Detail Ticket</h3>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-warning w-25 "
                                style="float: right">Modifier</button>
                        </div>
                    </div>
                    <!-- /.card-header -->


                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-7 col-sm-12">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Type du ticket</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select" name="type">
                                            <option value="Commercial" @if ($ticket->Type_Ticket == 'Commercial') selected @endif>
                                                Commercial</option>
                                            <option value="Technique" @if ($ticket->Type_Ticket == 'Technique') selected @endif>
                                                Technique</option>
                                            <option value="Administratif" @if ($ticket->Type_Ticket == 'Administratif') selected @endif>
                                                Administratif</option>
                                        </select>
                                    </div>

                                </div>

                            </div>




                            <div class="col-md-7 col-sm-12">
                                <div class="form-group row">
                                    <label for="userclient" class="col-sm-2 col-form-label">Utilisateurs</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="userClient" id="userclient"
                                            style="width: 100%;">
                                            @foreach ($userclients as $userclient)
                                                {{-- Check if the current user is the ticket user --}}
                                                @if ($ticket->user->id === $userclient->user->id)
                                                    <option value="{{ $ticket->user->id }}" selected>
                                                        {{ $ticket->user->email }}
                                                    </option>
                                                @else
                                                    <option value="{{ $userclient->user->id }}">
                                                        {{ $userclient->user->email }}
                                                    </option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->

                            <div class="col-md-8 col-sm-12">
                                <div class="form-group row">
                                    <label for="ticket" class="col-sm-2 col-form-label">Statut du Ticket</label>
                                    <div class="col-sm-10">
                                        <!-- select -->
                                        <select class="form-control" id="ticket" name="status" style="height: 40px;">
                                            @if ($ticket->status == 1)
                                                <option selected value="1">Traité</option>
                                                <option value="0">En Cours</option>
                                            @else
                                                <option value="1">Traité</option>
                                                <option selected value="0">En Cours</option>
                                            @endif


                                        </select>
                                    </div>

                                </div>

                            </div>
                            <!-- /.col -->

                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Détail de Ticket</label>
                                    <textarea class="form-control" name="detail" rows="3" placeholder="Enter ...">{{ $ticket->detail }}</textarea>
                                </div>
                            </div>


                            <div class="col-sm-12" id="Commentcontain">
                                <!-- textarea -->
                                <div class="form-group position-relative">
                                    <input type="text" name="comment" value="{{ old('comment', $personnaleTicket->comment) }}"
                                        class="form-control" placeholder="Enter ...">

                                </div>
                            </div>

                            @foreach ($outhertickets as $outherticket)
                                <div class="col-12"> <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="user image">
                                            <span class="username">
                                                <a
                                                    href="#">{{ $outherticket->user->firstName . ' ' . $outherticket->user->lastName }}</a>

                                            </span>
                                            <span class="description">Partagé publiquement -
                                                {{ Carbon\Carbon::parse($outherticket->update_at)->isoFormat('D MMMM YYYY à HH[h]mm') }}</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {{ $outherticket->comment }}
                                        </p>



                                    </div>
                                    <!-- /.post -->
                                </div>
                            @endforeach






                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </form>

                <form action="{{ route('dashboard.comment.ticket.store', Crypt::encrypt($ticket->id)) }}" method="post">
                    @csrf
                    <input class="form-control form-control-sm m-2" name="comment" style="width: 98%;" type="text"
                        placeholder="Entre a comment">
                </form>







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

        $(document).ready(function() {



            // Function to add new comment input
            function addAnswer() {
                let newComment = `
                <div class="form-group position-relative">
                    <input type="text" name="comment[]" class="form-control" placeholder="Enter ...">
                    <i class="fa fa-trash position-absolute removeBtn" 
                    style="right: 12px; color: red; bottom: 18px; z-index: 1000;"
                    aria-hidden="true"></i>
                    </div>`;

                $('#Commentcontain').append(newComment); // Append new comment input
            }

            // Event handler for removing comment
            $(document).on('click', '.removeBtn', function() {
                $(this).closest('.form-group').remove(); // Remove closest parent form-group
            });





        })
    </script>
@endsection
