  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
      <!-- /.tab-pane -->
      <div class="row">
          @foreach ($Qsm as $Qsm)
          @include('Cours.update.formation.delete.Qsm')
              <div class="col-4">
                  <div class="card" style="width: 18rem;">
                      <div class="card-header bg-light d-flex align-items-center justify-content-around">

                          <p class="m-0">{{ $Qsm->Question->question }}</p>

                          <h6 class="badge badge-secondary m-0">
                              {{ $Qsm->rateSeccess . '/' . $Qsm->Answercount }}
                          </h6>

                      </div>
                      <ul class="list-group list-group-flush">
                          @foreach ($Qsm->Question->Answers as $Answer)
                              <li class="list-group-item">{{ $Answer->Answer }}</li>
                          @endforeach

                          <li class="list-group-item "> <button style="float: right;" class="btn btn-sm bg-warning "
                                  data-toggle="modal" data-target="#update_Qsm_{{ $Qsm->id }}">
                                  <img src="{{ asset('asset/update_icon.png') }}" style="height: 18px;"
                                      alt="update_icon">
                              </button>


                              <button type="button" data-toggle="modal" data-target="#delete_Qsm_video_{{$Qsm->id}}"
                                  class="btn btn-sm btn-danger position-absolute" style="float: right">
                                  <i class="fa fa-trash" aria-hidden="true"></i>
                              </button>
                              @include('Cours.update.formation.update.QsmModel')
                              
                          </li>
                      </ul>
                  </div>
              </div>
          @endforeach
      </div>

  </div>

  <!-- /.tab-pane -->
