@if(session('success'))
    <div class="alert alert-success w-100 text-center" role="alert">
        {{ session('success') }}
    </div>
@endif
