<form method="post" action="{{ isset($ruta) ? $ruta : '' }}">
    @csrf
    @if(isset($method)) @method('PATCH') @endif

        <div class="form-group row my-4">
            <div class="col-md-6">
                <label for="name" class="form-label fw-bold">@lang('name')</label>
                <input  @if(isset($disabled)) disabled @endif value="@if(isset($user)){{ $user->name }}@endif" name="name" id="name" autocomplete="name"  class="form-control form-control-lg" placeholder="@lang('name')" required autofocus>
            </div>
            <div class="col-md-6">
                <label for="role_id" class="form-label fw-bold">@lang('roles')</label>
                <div class="row">
                    <div class="col-12">
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            @foreach ($roles as $role)
                                <input @if(isset($user)) @if($user->hasRole($role->name)) checked @endif @endif type="checkbox" class="btn-check" id="role{{ $role->id }}" value="{{ $role->id }}" name="roles[]" autocomplete="off">
                                <label class="btn btn-outline-primary" for="role{{ $role->id }}">{{ $role->name }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row my-4">
            <div class="col-md-6">
                <label for="username" class="form-label fw-bold">@lang('username')</label>
                <input  @if(isset($disabled)) disabled @endif value="@if(isset($user)){{ $user->username }}@endif" name="username" id="username" autocomplete="username"  class="form-control form-control-lg" placeholder="@lang('username')" required autofocus>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label fw-bold">@lang('email')</label>
                <input @if(isset($disabled)) disabled @endif value="@if(isset($user)){{ $user->email }}@endif" id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="@lang('email')" required autocomplete="email">
            </div>
        </div>
        @if(!isset($disabled))
            <div class="form-group row my-4">
                <div class="col-md-12">
                    <label for="password" class="form-label fw-bold">@if(isset($user)) @lang('new.password') @else @lang('password') @endif</label>
                    <input value="" id="password" type="password" class="form-control form-control-lg" placeholder="@if(!isset($user)) @lang('password') @endif" name="password" @if(!isset($user)) required @endif autocomplete="new-password">
                    @if(isset($user))<small class="text-muted d-block">@lang('if.blank.password')</small>@endif
                    <small class="text-muted d-block">@lang('min.8.char')</small>
                </div>
            </div>

            <div class="form-group row my-4">
                <div class="col-md-12">
                    <label for="filepond" class="form-label fw-bold">@lang('avatar')</label>
                    <input type="file" name="avatar" id="filepond" data-max-file-size="5MB">
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
                <label for="content" class="form-label fw-bold">@lang('avatar')</label>
                <div class="col-md-12">
                    <img width="150px" src="{{ $user->getMedia('media')->last()->getUrl() }}" alt="post">
                </div>
            </div>
        @endif
    </form>
