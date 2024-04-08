<!-- Modal -->
<div class="modal fade" id="update_Qsm_{{ $Qsm->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form action="{{ Route('dashboard.update.Qsm', Crypt::encrypt($Qsm->id)) }}" id="create_quiz"
                    method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group question">
                        <label for="Question">Question</label>
                        <input type="text" value="{{ old('Question', $Qsm->Question->question) }}"
                            class="form-control question_text " name="Question" id="Question"
                            placeholder="Entrez Question ...">
                    </div>

                    <div class="form-group">
                        <label for="RightAwnser">la bonne réponse</label>
                        <input type="text" value="{{ old('RightAwnser', $Qsm->Answer->Answer) }}"
                            class="form-control" required name="RightAwnser" id="RightAwnser"
                            placeholder="Entrez la bonne réponse ...">
                    </div>

                    <div class="d-flex justify-content-around  align-items-center" style="gap: 35px" id="addsection">

                        <div class="form-group row">
                            <label for="Rate">Sccess Rate ?</label>
                            <input type="text" value="{{ old('Rate', $Qsm->rateSeccess) }}" class="form-control"
                                required name="Rate" id="Rate" placeholder="Entrez Rate ...">
                        </div>
                        <div class="form-group row">
                            <label for="count">Combien tu Veux Envoyer ?</label>
                            <input type="text" value="{{ old('count', $Qsm->Answercount) }}" class="form-control"
                                required name="count" id="count" placeholder="Entrez la bonne réponse ...">
                        </div>
                    </div>

                    <div id="container">

                        @foreach ($Qsm->Question->Answers as $index => $Answer)
                            <div class="form-group reponse">
                                <label for="awnser_${index}" class="answer_label">la réponse {{ $index + 2 }}</label>
                                <div class="position-relative">
                                    <input name="awnser[]" type="text" value="{{ old('Answer', $Answer) }}"
                                        class="form-control response" required id="Awnser_${index}"
                                        aria-label="Text input with checkbox">

                                </div>
                            </div>
                        @endforeach


                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block btn-warning w-25 mt-2"
                                    style="float: right">Modifier
                                </button>
                            </div>


                        </div>
                </form>


            </div>

        </div>
    </div>
</div>
