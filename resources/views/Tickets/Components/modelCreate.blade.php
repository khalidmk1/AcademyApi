<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Crée Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ Route('dashboard.tickets.store') }}" method="post">
                @csrf
                <div class="modal-body">

                    <!-- select -->
                    <div class="form-group">
                        <label>Type de Ticket</label>
                        <select class="form-control" name="type_ticket">
                            <option value="Commercial"> Commercial</option>
                            <option value="Technique">Technique</option>
                            <option value="Administratif">Administratif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Utilisateur</label>
                        <select class="form-control select2" name="user" style="width: 100%;">
                            @foreach ($users as $user)
                                <option value="{{ $user->user->id }}">{{ $user->user->email }}</option>
                            @endforeach

                        </select>
                    </div>
                    <!-- /.form-group -->

                    <!-- textarea -->
                    <div class="form-group">
                        <label>Deatil</label>
                        <textarea class="form-control" name="detail" rows="3" placeholder="Enter ..."></textarea>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" multiple>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crée</button>
                </div>
            </form>
        </div>
    </div>
</div>
