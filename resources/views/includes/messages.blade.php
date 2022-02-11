@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger ">
            <p class="h4 mb-0 text-center">{{$error}}</p>
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success ">
        <p class="h4 mb-0 text-center">{{session('success')}}</p>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-info ">
        <p class="h4 mb-0 text-center">{{session('success')}}</p>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning ">
        <p class="h4 mb-0 text-center">{{session('warning')}}</p>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger ">
        <p class="h4 mb-0 text-center">{{session('error')}}</p>
    </div>
@endif
