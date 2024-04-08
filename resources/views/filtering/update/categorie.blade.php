<!-- Modal update -->
<div class="modal fade" id="update_categorie_model_{{$categorie->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modifier Catégorie</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{Route('dashboard.category.update' ,Crypt::encrypt($categorie->id) )}}" >
            @csrf
            @method('patch')
           
            <div class="modal-body">

                <div class="form-group">

                    <label for="categorie"> Nom de Categorie</label>
                    <input value="{{ old('category_name' , $categorie->category_name) }}" type="text"
                        class="form-control"  placeholder="Enter Nom de Categorie ..."
                        name="category_name">
                </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Modifier</button>
            </div>

        </form>

    </div>
</div>
</div>