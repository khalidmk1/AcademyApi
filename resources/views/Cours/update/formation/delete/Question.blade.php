   <!-- delete  -->
   <div class="modal fade" id="delete_Question_video_{{ $Question->id }}" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Modal title
                   </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="{{ Route('dashboard.delete.update.Qestion', Crypt::encrypt($Question->id)) }}"
                   method="POST">
                   @method('delete')
                   @csrf
                   <div class="modal-body">

                       <div class="form-group">
                           <label for="password">Mots de passe</label>
                           <input type="password" class="form-control" name="password" id="password"
                               placeholder="Entrez password ...">
                       </div>

                   </div>
                   <div class="modal-footer">

                       <button type="submit" class="btn btn-danger">Suprimer</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
