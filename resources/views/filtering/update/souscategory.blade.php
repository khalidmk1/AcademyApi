<!-- Modal update -->
<div class="modal fade" id="update_categorie_model_{{ $souscategory->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post"
                action="{{ Route('dashboard.souscategory.update', Crypt::encrypt($souscategory->id)) }}">
                @csrf
                @method('patch')

                <div class="modal-body">

                    <div class="form-group">

                        <div class="form-group">
                            <label>Categories </label>
                            <select name="category" class="form-control select2 select2-danger"
                                data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option
                                    value="{{ old('souscategory->category->category_name', $souscategory->category->category_name) }}">
                                    {{ $souscategory->category->category_name }}</option>
                                @foreach ($souscategories['categories'] as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->

                        <label for="categorie"> Nom de Categorie</label>
                        <input value="{{ old('souscategory_name', $souscategory->souscategory_name) }}" type="text"
                            class="form-control" placeholder="Enter Nom de Categorie ..." name="souscategory_name">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Modifier</button>
                </div>

            </form>

        </div>
    </div>
</div>
