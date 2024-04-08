<!-- Modal -->
<div class="modal fade" id="delete_category_{{ $souscategory->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suprimer Admin</h5>
            </div>
            <form action="{{ Route('dashboard.souscategorie.delete', Crypt::encrypt($souscategory->id)) }}"
                method="post">
                @csrf
                <div class="modal-body">
                    Vous éte sure que tu veux suprimer ?

                    <div class="form-group mt-3">
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter Voter Mots de Passe" name="password">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

                    <button type="submit" class="btn btn-danger">Confirmer</button>


                </div>
            </form>
        </div>
    </div>
</div>
