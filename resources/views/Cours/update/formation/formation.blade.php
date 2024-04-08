<!-- /.card-header -->
<form action="{{ Route('dashboard.update.formation', Crypt::encrypt($Cour->id)) }}" method="post">
    @method('patch')
    @csrf

    <div class="card-body">

        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" value="{{ old('title', $Cour->title) }}" class="form-control" name="title" id="title"
                placeholder="Entrez Titre ...">
        </div>

        <div class="row">
            <div class="form-group clearfix col-6">
                <div class="icheck-primary d-inline">
                    <input type="checkbox" name="iscoming" id="iscoming" {{ $Cour->isComing == 1 ? 'checked' : '' }}>
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
                <input type="checkbox" name="isActive" id="boostrap-switch" checked data-value="" data-bootstrap-switch
                    data-off-color="danger" data-on-color="success">
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
                    <select class="form-control select2" id="souscategory_goals" name="cotegoryId" style="width: 100%;">
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



        <section id="formation" class="p-3" style="background-color: rgba(208, 144, 16, 0.35) ; border-radius:20px ">


            <div class="form-group">
                <label for="ImageFomation">Image de Fomation</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="ImageFomation">
                    <label class="custom-file-label" for="ImageFomation">Choisez image</label>
                </div>
            </div>



            <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                    <input type="checkbox" name="iscertify" id="certifier"
                        {{ $coursFormation->isCertify == 1 ? 'checked' : '' }}>
                    <label for="certifier">
                        Certifier
                    </label>
                </div>

            </div>

            <!-- textarea -->
            <div class="form-group">
                <label>Conditions d’éligibilité</label>
                <textarea class="form-control" name="conditionformation" rows="3" placeholder="Enter ...">{{ $coursFormation->condition }}</textarea>
            </div>


            <div class="form-group">
                <label>Formateur</label>
                <select class="form-control select2" name="hostPodcast" style="width: 100%;">
                    @foreach ($HostFromateur as $Host)
                        @if (isset($coursFormation->user->email) && $Host->user->email == $coursFormation->user->email)
                            <option value="{{ $Host->user->id }}">{{ $Host->user->email }}
                            </option>
                        @else
                            <option value="{{ $Host->user->id }}">{{ $Host->user->email }}</option>
                        @endif
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label>Programme</label>
                <select class="form-control select2" name="programId" style="width: 100%;">
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}"
                            {{ $coursFormation->program_id == $program->id ? 'selected' : '' }}>
                            {{ $program->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- /.form-group -->




            <div class="form-group">
                <label for="DocumentFomation">Documents de Fomation</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="DocumentFomation" multiple>
                    <label class="custom-file-label" for="DocumentFomation">Choisez Documents</label>
                </div>
            </div>





        </section>



    </div>

    <button type="submit" class="btn btn-block btn-warning w-25 " style="float: right">Modifier
        Contnu</button>

</form>



<!-- /.tab-pane -->
