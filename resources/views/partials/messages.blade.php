@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <span>{{ $error }}</span>
        @endforeach
    </div>
@endif


@if (session('api_error_message'))
    <div class="alert alert-danger" role="alert">{{ session('api_error_message') }}</div>
@endif


@if (session('success_message'))
    <div class="alert alert-success" role="alert"> {{ session('success_message') }}</div>
@endif