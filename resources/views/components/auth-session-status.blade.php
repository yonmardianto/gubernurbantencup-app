@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>Success:</strong> {{ $message }}
    </div>
@endif



