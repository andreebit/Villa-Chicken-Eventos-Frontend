@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <span>{{ $error }}</span><br>
        @endforeach
    </div>
@endif


@if (session('api_error_message'))
    <div class="alert alert-danger" role="alert">
        {{ session('api_error_message') }}
        @if(session('api_error_detail'))
            <br>
            @foreach(session('api_error_detail') as $item)
                @foreach($item as $detail)
                    {{ $detail }}<br>
                @endforeach
            @endforeach
        @endif
    </div>
@endif


@if (session('error_message'))
    <div class="alert alert-success" role="alert"> {{ session('error_message') }}</div>
@endif


@if (session('success_message'))
    <div class="alert alert-success" role="alert"> {{ session('success_message') }}</div>
@endif