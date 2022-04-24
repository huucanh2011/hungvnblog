@if (session('notify'))
    <div class="alert alert-{{ session('notify-type') ?? 'success' }} alert-dismissible fade show" role="alert">
        {{ session('notify') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
