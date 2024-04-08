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
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mange Contenu Video Formation</h1>
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

    <section class="content">
        <div class="container-fluid">
            <div id="message_containe"></div>
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Crée Video</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ Route('dashboard.store.video.fomation') }}" id="create_videos" method="post">
                        <input type="text" name="courFormationId" hidden value="{{ $courId->id }}">
                        @csrf
                        <div class="card-body">


                            <div class="form-group">
                                <label for="titleVideo">Titre video</label>
                                <input type="text" value="{{ old('titleVideo') }}" class="form-control" name="titleVideo"
                                    id="titleVideo" placeholder="Entrez Titre ...">
                            </div>

                            <!-- textarea -->
                            <div class="form-group">
                                <label>Description de video</label>
                                <textarea class="form-control" name="descriptionVideo" rows="3" placeholder="Enter ..."></textarea>
                            </div>


                            <div class="form-group">
                                <label for="tags_video">Mots Clé</label>
                                <input type="text" class="form-control" name="videoTags[]" id="tags-input" />
                            </div>


                        </div>

                        <button type="submit" class="btn btn-block btn-dark w-50 mb-3 ml-3">Crée Videos</button>
                    </form>

                    <div class="row row-cols-1 row-cols-md-3 vidoeContent">


                    </div>


                </div>
            </div>


        </div>
    </section>



    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


    <script>
        $(document).ready(function() {

            //tags
            var tagInputEle = $('#tags-input');
            tagInputEle.tagsinput();

            $('#create_videos').submit(function(e) {
                e.preventDefault();
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

                        $('#create_videos')[0].reset();

                        $('.vidoeContent').html(response.output)
                        $('body,html').animate({
                            scrollTop: $('body').height()
                        }, 800);




                    },
                    error: function(xhr, textStatus, errorThrown) {

                        $('html, body').animate({
                            scrollTop: "0px"
                        }, 800);

                        console.log(xhr);
                        console.log(textStatus);
                        console.log(errorThrown);


                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';


                        $.each(errors, function(field, messages) {
                            $.each(messages, function(key, message) {
                                errorMessages +=
                                    '<div class="alert alert-warning alert-dismissible fade show ml-1" role="alert">';
                                errorMessages +=
                                    '<i class="icon fas fa-exclamation-triangle"></i> ' +
                                    message;
                                errorMessages +=
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                errorMessages +=
                                    '<span aria-hidden="true">&times;</span></button></div>';
                            });
                        });

                        $('#message_containe').html(errorMessages);
                    },
                })


            })


        })
    </script>
@endsection
