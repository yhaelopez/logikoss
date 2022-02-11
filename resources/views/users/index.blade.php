@extends('layouts.dashboard')

@section('main')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">@lang('users')</h1>
            </div>
            <div class="col-12 pt-4 text-center">
                <a class="btn btn-success btn-lg" href="{{ route('users.create') }}">@lang('crear') <i class="bi bi-people-fill"></i></a>
            </div>
            <div class="col-12 py-4">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                      <a class="nav-link @if(!request()->has('trashed')) bg-primary active @endif" @if(!request()->has('trashed')) aria-current="page" @endif href="{{ route( 'users.index') }}">Habilitados</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @if(request()->has('trashed')) bg-danger active @endif" @if(request()->has('trashed')) aria-current="page" @endif href="{{ route( 'users.index', ['trashed'] ) }}">Deshabilitados</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">

                <div class="table-responsive">
                    <table id="users" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="align-middle d-none d-sm-table-cell">#</th>
                                <th class="align-middle d-none d-sm-table-cell">@lang('name')</th>
                                <th class="align-middle d-none d-sm-table-cell">@lang('email')</th>
                                {{-- <th class="align-middle d-none d-sm-table-cell">@lang('role')</th> --}}
                                <th class="align-middle d-none d-sm-table-cell">@lang('created.at')</th>
                                <th class="align-middle d-none d-sm-table-cell">@lang('acciones')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td class="align-middle d-none d-sm-table-cell fw-bold">{{ $key+1 }}</td>
                                <td class="align-middle d-none d-sm-table-cell">{{ $user->name }}</td>
                                <td class="align-middle d-none d-sm-table-cell">{{ $user->email }}</td>
                                {{-- <td class="align-middle d-none d-sm-table-cell">
                                    @switch($user->roles[0]->id)
                                        @case(1)
                                            <span class="badge rounded-pill bg-dark">{{ $user->roles[0]->name }}</span>
                                            @break
                                        @case(2)
                                            <span class="badge rounded-pill bg-danger">{{ $user->roles[0]->name }}</span>
                                            @break
                                        @case(3)
                                            <span class="badge rounded-pill bg-primary">{{ $user->roles[0]->name }}</span>
                                            @break
                                        @case(4)
                                            <span class="badge rounded-pill bg-success">{{ $user->roles[0]->name }}</span>
                                            @break
                                        @case(5)
                                            <span class="badge rounded-pill bg-warning text-dark">{{ $user->roles[0]->name }}</span>
                                            @break
                                        @case(6)
                                            <span class="badge rounded-pill bg-info text-dark">{{ $user->roles[0]->name }}</span>
                                            @break
                                        @default
                                    @endswitch
                                </td> --}}
                                <td class="align-middle d-none d-sm-table-cell">{{ $user->created_at->formatLocalized('%e/%b/%Y') }}</td>
                                <td class="align-middle text-nowrap">
                                    <a href="{{ route('users.show', ['user' => $user]) }}" type="button" class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{ route('users.edit', ['user' => $user]) }}" type="button" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                    {{-- @can('delete', $user) --}}
                                    <form class="d-inline" action="{{ route('users.destroy', ['user' => $user]) }}" method="post" class="p-0 m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></i></button>
                                    </form>
                                    {{-- @endcan --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    function confirmarFormularioModal(id) {
        document.getElementById('forceDeleteForm'+id).submit();
    }

    window.onload = () => {
        $('#users').DataTable({
            dom: 'lBfrtip',
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            'order': [
                [ 0, 'desc' ]
            ],
            'pageLength': 10,
        });
    };
</script>
@endsection
