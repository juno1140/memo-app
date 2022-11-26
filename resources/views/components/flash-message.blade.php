@if(session('flash_alert'))
    <div class="alert alert-danger m-0 text-center">
        {{ session('flash_alert') }}
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success text-center">
        {{ session('status') }}
    </div>
@endif
