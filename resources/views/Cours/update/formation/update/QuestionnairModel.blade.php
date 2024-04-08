 <!-- Modal -->
 <div class="modal fade" id="update_Qsm_{{ $Question->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel_{{ $Question->id }}" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel_{{ $Question->id }}">Modifier Question</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{ Route('dashboard.update.Question', Crypt::encrypt($Question->id)) }}"
                     id="update_question_form_{{ $Question->id }}" method="post">
                     @csrf
                     @method('patch')
                     <div class="form-group question">
                         <label for="Question">Question</label>
                         <input type="text" value="{{ old('Question', $Question->Question) }}"
                             class="form-control question_text" name="Question" id="Question_{{ $Question->id }}"
                             placeholder="Entrez la question...">
                     </div>
                     <div class="row">
                         <div class="col-12">
                             <button type="submit" class="btn btn-block btn-warning w-25 mt-2"
                                 style="float: right">Modifier</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
