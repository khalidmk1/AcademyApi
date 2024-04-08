<!-- Modal update -->
<div class="modal fade" id="update_goal_model_{{$goal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Objectifs {{$goal->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{Route('dashboard.goals.update' ,Crypt::encrypt($goal->id) )}}" >
                @csrf
                @method('patch')
               
                <div class="modal-body">

                    <div class="form-group">
                        <label>SousCategorie</label>
                        <select name="souscatgory" class="form-control select2 select2-danger"
                            data-dropdown-css-class="select2-danger" style="width: 100%;">
                            @foreach ($goals['souscategory'] as $souscategory)
                                <option value="{{ $souscategory->id }}">{{ $souscategory->souscategory_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
    
                        <label for="goals"> Nom de Objectif</label>
                        <input value="{{ old('goals' , $goal->goals) }}" type="text"
                            class="form-control"  placeholder="Enter Nom de Categorie ..."
                            name="goals">
                    </div>
    
    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Modifier</button>
                </div>
    
            </form>
    
        </div>
    </div>
    </div>