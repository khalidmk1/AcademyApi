<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Crée FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ Route('dashboard.FAQ.store') }}" method="post">
                @csrf
                <div class="modal-body">

                  <!-- textarea -->
                  <div class="form-group">
                    <label>Question</label>
                    <input type="text" value="{{ old('Question') }}" class="form-control"
                    name="Question" id="Question" placeholder="Entrez Nom ...">
                </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label>Réponse</label>
                        <textarea class="form-control" name="answer" rows="3" placeholder="Enter ..."></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crée</button>
                </div>
            </form>
        </div>
    </div>
</div>
