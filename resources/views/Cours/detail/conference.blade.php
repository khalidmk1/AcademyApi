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

        .select2-container--default .select2-selection--single {
            height: 40px !important;
        }
    </style>


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Voir Tout Les Contenus</h1>
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
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">
                                {{ $coursCoference->user->firstName . ' ' . $coursCoference->user->lastName }}</h3>

                            <p class="text-muted text-center">{{ $coursCoference->user->userspeaker->type_speaker }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nomber de Conférencier</b> <a class="float-right"> {{ $ConfrenceGuest->count() }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Views</b> <a class="float-right">543</a>
                                </li>

                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Conférencier</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @foreach ($ConfrenceGuest as $guest)
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted">
                                            {{ $guest->user->firstName . ' ' . $guest->user->lastName }}
                                        </p>
                                    </div>


                                </div>

                                <hr>
                            @endforeach




                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Detail</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Modifier</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Parameter</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">


                                    <!-- Post -->
                                    <div class="post">

                                        <div class="d-flex align-items-center">
                                            <h1 class="username">
                                                <div>{{ $Cour->title }}</div>

                                            </h1>
                                            <h5 class="ml-4 badge badge-success">{{ $Cour->isActive ? 'Active' : '' }}</h5>
                                            <h5 class="ml-4 badge badge-warning">{{ $Cour->isComing ? 'A Venir' : '' }}</h5>
                                        </div>
                                        <!-- /.user-block -->

                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid mb-3" src="../../dist/img/photo2.png"
                                                            alt="Photo">
                                                        <img class="img-fluid" src="../../dist/img/photo3.jpg"
                                                            alt="Photo">
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg"
                                                            alt="Photo">
                                                        <img class="img-fluid" src="../../dist/img/photo1.png"
                                                            alt="Photo">
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                    </div>
                                    <!-- /.post -->


                                    <!-- Post -->
                                    <div class="post">
                                        <div class="d-flex">
                                            <i class="fa fa-exclamation-circle" style="font-size: x-large"
                                                aria-hidden="true"></i>
                                            <div class="ml-2"><strong>Description.</strong></div>

                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {{ $Cour->description }}
                                        </p>

                                    </div>
                                    <!-- /.post -->


                                    <!-- Post -->
                                    <div class="post">
                                        <div class="d-flex">
                                            <i class="fa fa-exclamation-circle" style="font-size: x-large"
                                                aria-hidden="true"></i>
                                            <div class="ml-2"><strong>Mots Clé.</strong></div>

                                        </div>
                                        <!-- /.user-block -->
                                        <div class="d-flex" style="gap: 2px">
                                            @foreach ($Cour->tags as $tag)
                                                <h5><span class="badge badge-secondary">{{ $tag }}</span></h5>
                                            @endforeach
                                        </div>


                                    </div>
                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post clearfix">
                                        <div class="d-flex">
                                            <i class="fa fa-exclamation-circle" style="font-size: x-large"
                                                aria-hidden="true"></i>
                                            <div class="ml-2 mb-2"><strong>Video.</strong></div>

                                        </div>


                                        <div class="row">
                                            @foreach ($Cour->CoursConference->ConferenceVideo as $video)
                                                @include('Cours.update.conference.video.conference')

                                                <div class="col-12">
                                                    <!-- Card -->

                                                    <div class="card">

                                                        <div class="row">
                                                            <div class="col-4">

                                                            </div>
                                                            <div class="col-8">
                                                                <div class="text-white  m-2 "
                                                                    style="border-radius: 20px ; background: #343a4070 ">
                                                                    <div class="position-relative ">
                                                                        <!-- Button trigger modal -->
                                                                        <button style="right: 0;"
                                                                            class="btn btn-sm bg-warning position-absolute update_video_btn"
                                                                            data-toggle="modal" data-id="{{$video->id}}"
                                                                            data-target="#update_video_{{ $video->id }}">
                                                                            <img src="{{ asset('asset/update_icon.png') }}"
                                                                                style="height: 18px;" alt="update_icon">
                                                                        </button>



                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#delete_video_{{ $video->id }}"
                                                                            class="btn btn-sm btn-danger position-absolute"
                                                                            style="float: right">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </button>
                                                                    </div>

                                                                    <div class="card-body">


                                                                        <h3 class="pt-2">
                                                                            {{ $video->title }}
                                                                        </h3>

                                                                        <ul class="list-inline projects">
                                                                            @foreach ($video->guestvideo as $guest)
                                                                                <li class="list-inline-item">
                                                                                    <img alt="Avatar"
                                                                                        class="table-avatar"
                                                                                        src="../../dist/img/avatar.png">
                                                                                </li>
                                                                            @endforeach


                                                                        </ul>

                                                                        <p class="text">{{ $video->description }}.</p>



                                                                        <h5 class="pink-text text-right">
                                                                            {{ $video->duration }}</h5>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Content -->


                                                    </div>
                                                    <!-- Card -->
                                                </div>
                                            @endforeach

                                        </div>


                                    </div>
                                    <!-- /.post -->


                                </div>


                                @include('Cours.update.conference.conference')

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


    <script>
        $(function() {
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

            //Initialize Select2 Elements
            $('.select2').select2();
            $('.select3').select2();


            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })


            $(document).ready(function() {

                //tags

                
                $('.update_video_btn').on('click', function() {
                    //tags
                    var targetId = $(this).attr('data-id');
                    var tagVideo = $('#tags-input-' + targetId);
                    tagVideo.tagsinput();

                })
                var tagCour = $('#tags-input');
                tagCour.tagsinput();



                //search live for goals

                $('#souscategory_goals').on('change', function() {
                    var sousCategorieId = $(this).val();

                    $.ajax({
                        url: '/backoffice/goals-bySouscategory/' +
                            sousCategorieId,
                        method: 'GET',
                        success: function(response) {
                            var goalsSelect = $('#goals_option');
                            goalsSelect.empty();

                            /* window.navigate("page.html"); */

                            console.log(response);

                            $.each(response.goals, function(index, goal) {
                                goalsSelect.append($('<option>', {
                                    value: goal.id,
                                    text: goal.goals
                                }));

                                console.log(goal.id);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching goals:', error);
                        }
                    });
                });






            })

        })
    </script>
@endsection
