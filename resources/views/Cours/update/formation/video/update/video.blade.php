   <!-- Update video Conference -->
   <div class="modal fade" id="update_video_{{ $video->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier video
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ Route('dashboard.update.video.formation', Crypt::encrypt($video->id)) }}" method="post">
                @method('patch')
                @csrf
                <div class="modal-body">



                    <!-- /.card-header -->



                  {{--   <input hidden type="text" name="confrenceId" value="{{ $Cour->CoursConference->id }}"> --}}

                    <div class="form-group">
                        <label for="titleVideo">Titre video</label>
                        <input type="text" value="{{ old('titleVideo', $video->title) }}" class="form-control"
                            name="titleVideo" id="titleVideo" placeholder="Entrez Titre ...">
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label>Description de video</label>
                        <textarea class="form-control" name="descriptionVideo" rows="3" placeholder="Enter ...">{{ $video->description }}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="tags_video">Mots Clé</label>
                        <input type="text" class="form-control tags" value="{{ implode(',', $video->tags) }} "
                            name="videoTags[]" data-id="{{$video->id}}" id="tags-input-{{$video->id}}" />
                    </div>

                    <!-- time Picker -->
                    <div class="form-group">
                        <label for="videoduration">Duration</label>
                        <input type="time" class="form-control" id="videoduration" name="videoduration"
                            value="00:00:00" step="1">
                    </div>



                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-block btn-warning w-50">Modifier Videos</button>
                </div>
            </form>
        </div>
    </div>
</div>