@if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert  alert-danger alert-dismissible fade show ml-1" role="alert">
                <i class="icon fas fa-exclamation-triangle"></i> {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
    
    @if (session('status'))
       
            <div class="alert  alert-success alert-dismissible fade show ml-1" role="alert">
                <i class="icon fas fa-exclamation-triangle"></i> {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
       
    @endif

    @if (session('faild'))
       
            <div class="alert  alert-warning alert-dismissible fade show ml-1" role="alert">
                <i class="icon fas fa-exclamation-triangle"></i> {{ session('faild') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
       
    @endif