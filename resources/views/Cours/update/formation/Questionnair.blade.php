<div class="tab-pane fade" id="pills-Qestion" role="tabpanel" aria-labelledby="pills-Qestion-tab">
    <div class="row">
        @foreach ($Questions as $index => $Question)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $index + 1 }}. {{ $Question->Question }}</h5>
                        <div class="d-flex justify-content-end" style="gap: 2px">
                            <button style="float: right;" class="btn btn-sm bg-warning" data-toggle="modal"
                                data-target="#update_Qsm_{{ $Question->id }}">
                                <img src="{{ asset('asset/update_icon.png') }}" style="height: 18px;" alt="update_icon">
                            </button>
                            <button type="button" data-toggle="modal" data-target="#delete_Question_video_{{ $Question->id }}"
                                class="btn btn-sm btn-danger" style="float: right">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            @include('Cours.update.formation.update.QuestionnairModel')
            @include('Cours.update.formation.delete.Question')
        @endforeach
    </div>
</div>
