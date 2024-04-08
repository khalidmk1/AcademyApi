@extends('Layouts.master')

@section('content')
    <style>
        .name {
            font-size: 22px;
            font-weight: bold
        }

        .idd {
            font-size: 14px;
            font-weight: 600
        }

        .idd1 {
            font-size: 12px
        }



        .text span {
            font-size: 13px;
            color: #545454;
            font-weight: 500
        }



        .date {
            background-color: #ccc
        }
    </style>

    @include('Component.styling.css')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contacts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Contacts</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('Layouts.errorshandler')

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">

            <div class="card-header">

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" id="search_speaker" name="table_search" class="form-control float-right"
                            placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>


            <div class="card-body pb-0">
                <div class="row" id="resultUser">
                    @foreach ($speakers as $speaker)
                        @include('Component.Profile.delete.speaker')


                        <div class=" mb-2 p-3 col-4">
                            <div class="card bg-light p-4">
                                <div class=" image d-flex flex-column justify-content-center align-items-center">
                                    <img class="rounded mx-auto d-block" src="../../dist/img/user1-128x128.jpg"
                                        alt="user-avatar" height="100" width="100" />
                                    <div class="text mt-3">
                                        <strong>{{ $speaker->user->userspeaker->type_speaker }}</strong>
                                    </div>
                                    <span
                                        class="name mt-3">{{ $speaker->user->firstName . ' ' . $speaker->user->lastName }}</span>
                                    <span class="idd">{{ $speaker->user->email }}</span>
                                    <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                        <span class="idd1">{{ $speaker->user->userspeaker->biographie }}</span>
                                    </div>

                                    <div class="text-right  mt-3">
                                        <a href="{{ Route('dashboard.profile.edit', Crypt::encrypt($speaker->user->id)) }}"
                                            class="btn btn-sm bg-warning mr-3">
                                            <img src="{{ asset('asset/update_icon.png') }}" style="height: 18px;"
                                                alt="update_icon">
                                        </a>
                                        <button type="button" data-toggle="modal" style="float: right"
                                            data-target="#delete_admin_{{ $speaker->user->id }}"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>


            <!-- /.card-body -->
            <div class="card-footer">
                <nav aria-label="Contacts Page Navigation">
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item ">{{ $speakers->links() }}</li>

                    </ul>
                </nav>
            </div>
            <!-- /.card-footer -->
        </div>
    </section>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#search_speaker').on('keyup', function() {

                var speaker = $(this).val()

                var url = 'http://192.168.137.187:8000/backoffice/search/pofile'


                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        'speaker': speaker,
                    },
                    success: function(data) {
                        console.log(data);

                        $('#resultUser').empty();

                        $('#resultUser').append(data)


                    },
                    error: function(error) {
                        console.log(error);

                    }
                });

            })

        })
    </script>
@endsection
