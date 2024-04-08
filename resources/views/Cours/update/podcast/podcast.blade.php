  <!-- /.tab-pane -->
  <div class="tab-pane" id="timeline">


      <!-- /.card-header -->
      <form action="{{ Route('dashboard.update.podcast', Crypt::encrypt($Cour->id)) }}" method="post">
          @method('patch')
          @csrf

          <div class="card-body">

              <div class="form-group">
                  <label for="title">Titre</label>
                  <input type="text" value="{{ old('title', $Cour->title) }}" class="form-control" name="title"
                      id="title" placeholder="Entrez Titre ...">
              </div>

              <div class="row">
                  <div class="form-group clearfix col-6">
                      <div class="icheck-primary d-inline">
                          <input type="checkbox" name="iscoming" id="iscoming"
                              {{ $Cour->isComing == 1 ? 'checked' : '' }}>
                          <label for="iscoming">
                              Coming Soon
                          </label>
                      </div>

                  </div>
                  <div class="col-6">
                      <!-- Bootstrap Switch -->
                      <label for="boostrap-switch" class="mr-5">
                          Affichage
                      </label>
                      <input type="checkbox" name="isActive" id="boostrap-switch" checked data-value=""
                          data-bootstrap-switch data-off-color="danger" data-on-color="success">
                  </div>
                  <!-- /.card -->

              </div>


              <!-- textarea -->
              <div class="form-group">
                  <label>Description de Contenu</label>
                  <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ old('description', $Cour->description) }}</textarea>
              </div>


              <div class="form-group">
                  <label for="tags">Mots Clé</label>

                  <input type="text" class="form-control" value="{{ implode(',', $Cour->tags) }}" name="tags[]"
                      id="tags-input" />

              </div>

              <div class="row">
                  <div class="col-6">
                      <div class="form-group">
                          <label>SousCategorie</label>
                          <select class="form-control select2" id="souscategory_goals" name="cotegoryId"
                              style="width: 100%;">
                              <option>Choise Votre SousCategorie</option>
                              @foreach ($souscategory as $souscategory)
                                  <option value="{{ $souscategory->category->id }}"
                                      {{ $Cour->category->id == $souscategory->category->id ? 'selected' : '' }}>
                                      {{ $souscategory->category->category_name }}
                                  </option>
                              @endforeach

                          </select>
                      </div>
                      <!-- /.form-group -->






                  </div>
                  <div class="col-6">

                      <div class="form-group">
                          <label for="goals_option">Objectifs</label>
                          <select class="select3" name="gaols_id[]" multiple="multiple" id="goals_option"
                              data-placeholder="Select a State" style="width: 100%;">
                              @foreach ($CoursGols as $goal)
                                  <option selected value="{{ $goal->id }}">{{ $goal->goals }}</option>
                              @endforeach

                          </select>
                      </div>
                      <!-- /.form-group -->

                     

                  </div>


              </div>


              <section id="conference" class="p-3"
                  style="background-color: rgba(151, 120, 46, 0.46) ; border-radius:20px ">

                  <div class="position-relative"></div>

                  <div class="form-group">
                      <label for="slug_acroche">Acroche</label>
                      <input type="text" value="{{ old('slug' , $coursPodcast->slug ) }}" class="form-control" name="slugAcroche"
                          id="slug_acroche" placeholder="Entrez Acroche ...">
                  </div>

                  <div class="form-group">
                      <label>Modirateur</label>
                      <select class="form-control select2" name="hostPodcast"  style="width: 100%;">
                          @foreach ($HostPodcast as $Host)
                              @if (isset($coursPodcast->user->email) && $Host->user->email == $coursPodcast->user->email)
                                  <option value="{{ $Host->user->id }}">{{ $Host->user->email }}
                                  </option>
                              @else
                                  <option value="{{ $Host->user->id }}">{{ $Host->user->email }}</option>
                              @endif
                          @endforeach
                      </select>
                  </div>

                  <!-- /.form-group -->





                  <!-- textarea -->
                  <div class="form-group">
                      <label>Description de Conférence</label>
                      <textarea class="form-control" name="descriptionPodcast" rows="6" placeholder="Enter ...">{{ $coursPodcast->description }}</textarea>
                  </div>

                  <div class="form-group">
                      <label for="coursImage">Image</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" {{-- name="image" --}} id="coursImage">
                          <label class="custom-file-label" for="customFile">Choisez image</label>
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-md-8">

                          <div class="form-group">
                              <label for="coursVideo">Video</label>
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" {{-- name="video" --}} id="coursVideo">
                                  <label class="custom-file-label" for="coursVideo">Choisez Video</label>
                              </div>
                          </div>



                      </div>
                      <div class="col-md-4">

                          <!-- time Picker -->
                          <div class="form-group">
                              <label for="coursDuration">Duration</label>
                              <input type="time" class="form-control" value="" id="coursDuration"
                                  name="coursDuration" value="{{ $coursPodcast->duration }}" step="1">
                          </div>

                      </div>

                  </div>


              </section>



          </div>

          <button type="submit" class="btn btn-block btn-warning w-25 " style="float: right">Modifier
              Contnu</button>

      </form>


  </div>
  <!-- /.tab-pane -->
