<div class="card QSM_Quiz">
    <form action="{{ Route('dashboard.delete.Qsm', Crypt::encrypt($Question->id)) }}" method="post" class="delete_Qsm">
        @csrf
        <button type="button" class="btn btn-sm btn-danger position-absolute" style="right: 6px; top: 4px;">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </form>
    <div class="card-body">
        <h2>{{ $Question->question }}</h2>

        <ol type="A">
            @foreach ($Question->Answers as $Answer)
                <li style="font-family: 'Poppins'; font-size: larger;">
                    <span>{{ $Answer->Answer }}</span>
                </li>
            @endforeach
        </ol>

    </div>
</div>


<script>
    $(document).ready(function() {

        //delete QSM
        $('.delete_Qsm').on('click', function(e) {
            e.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                success: function(response) {

                    console.log(response);

                    if (response.message) {

                        var errorMessage =
                            '<div class="alert alert-danger alert-dismissible fade show ml-1" role="alert">';
                        errorMessage += '<i class="icon fas fa-exclamation-triangle"></i> ';
                        errorMessage += response.message;
                        errorMessage +=
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        errorMessage +=
                            '<span aria-hidden="true">&times;</span></button></div>';

                        $('#message_containe').html(errorMessage);

                        $('html, body').animate({
                            scrollTop: "0px"
                        }, 800);

                    }

                    $('.QSM_Quiz').remove()

                },
                error: function(request, error) {
                    console.log(arguments);
                    console.log(error);

                },
            })

        })
    })
</script>
