<!-- Modal update -->
<div class="modal fade" id="update_program_model_{{ $program->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ Route('dashboard.program.update', Crypt::encrypt($program->id)) }}">
                @csrf
                @method('patch')

                <div class="modal-body">

                    <div class="form-group">
                        <label for="title"> Titre</label>
                        <input value="{{ old('title', $program->title) }}" type="text" class="form-control"
                            id="title" placeholder="Enter Nom de Categorie ..." name="title">
                    </div>

                    <div class="form-group">
                        <label for="Description"> Description</label>
                        <textarea class="form-control" aria-valuetext="{{ old('Description', $program->Description) }}" id="Description"
                            name="Description" rows="3" placeholder="Entrez Description ...">{{ $program->Description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="tags">Mots Clé</label>
                        <input type="text" class="form-control" name="tags[]" id="tag-input_{{ $program->id }}"
                            data-id="{{ $program->id }}"
                            value="@foreach ($program->tags as $tag){{ $tag }}@if (!$loop->last),@endif @endforeach" />


                    </div>

                    <div class="form-group">
                        <label>Categories</label>
                        <select class="select2" multiple="multiple" name="categories[]" data-placeholder="Select Categories" style="width: 100%;">
                            @foreach ($program->categories as $categorie) 
                                <option selected value="{{ $categorie }}">{{ $categorie }}</option>
                            @endforeach
                            @foreach ($categories_programs['categories'] as $category)
                                @if (!collect($program->categories)->contains($category->category_name))
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Modifier</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var tagInputEle_update = $('#tag-input_{{ $program->id }}');
        var id = tagInputEle_update.attr('data-id')
        console.log(id);
        tagInputEle_update.tagsinput();
    });
</script>
