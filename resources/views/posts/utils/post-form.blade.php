<form method="post" action="{{ isset($ruta) ? $ruta : '' }}">
    @csrf
    @if(isset($method)) @method('PATCH') @endif

    <div class="form-group row my-4">
        <div class="col-md-12">
            <label for="title" class="form-label fw-bold">@lang('title')</label>
            <input  @if(isset($disabled)) disabled @endif value="@if(isset($post)){{ $post->title }}@endif" name="title" id="title" autocomplete="title"  class="form-control form-control-lg" placeholder="@lang('title')" required autofocus>
        </div>

    </div>
    <div class="form-group row my-4">
        <div class="col-md-12">
            <label for="content" class="form-label fw-bold">@lang('content')</label>
            <textarea  @if(isset($disabled)) disabled @endif name="content" id="content" autocomplete="content"  class="form-control form-control-lg" placeholder="@lang('content')" required>
                @if(isset($post)){!! $post->content !!}@endif
            </textarea>
        </div>
    </div>
    @if(!isset($disabled))

        <div class="form-group row my-4">
            <div class="col-md-12">
                <label for="filepond" class="form-label fw-bold">@lang('image')</label>
                <input type="file" name="image" id="filepond" data-max-file-size="5MB">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    @lang('btn.guardar')
                </button>
            </div>
        </div>
    @else

    <div class="form-group row my-4">
        <label for="content" class="form-label fw-bold">@lang('image')</label>
        <div class="col-md-12">
            <img width="150px" src="{{ $post->getMedia('posts')->last()->getUrl() }}" alt="post">
        </div>
    </div>

    @endif
</form>
