@extends('layouts.dashboard')

@section('main')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">@lang('posts')</h1>
            </div>
            <div class="col-12 pt-4 text-center">
                <a class="btn btn-success btn-lg" href="{{ route('posts.create') }}">@lang('crear') <i class="bi bi-people-fill"></i></a>
            </div>
            <div class="col-12">

                <div class="table-responsive">
                    <table id="posts" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="align-middle d-none d-sm-table-cell">@lang('actions')</th>
                                <th class="align-middle d-none d-sm-table-cell">#</th>
                                <th class="align-middle d-none d-sm-table-cell">@lang('slug')</th>
                                <th class="align-middle d-none d-sm-table-cell">@lang('title')</th>
                                <th class="align-middle d-none d-sm-table-cell">@lang('image')</th>
                                <th class="align-middle d-none d-sm-table-cell">@lang('created.at')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $key => $post)
                            <tr>
                                <td class="align-middle text-nowrap">
                                    <a href="{{ route('posts.show', ['post' => $post]) }}" type="button" class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{ route('posts.edit', ['post' => $post]) }}" type="button" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                    <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post]) }}" method="post" class="p-0 m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></i></button>
                                    </form>
                                </td>
                                <td class="align-middle d-none d-sm-table-cell fw-bold">{{ $key+1 }}</td>
                                <td class="align-middle d-none d-sm-table-cell">{{ $post->slug }}</td>
                                <td class="align-middle d-none d-sm-table-cell">{{ $post->title }}</td>
                                <td class="align-middle d-none d-sm-table-cell">
                                    @if ($post->getMedia('posts')->last())
                                    <img width="120px" src="{{ $post->getMedia('posts')->last()->getUrl() }}" alt="avatar">
                                    @endif
                                </td>
                                <td class="align-middle d-none d-sm-table-cell">{{ $post->created_at->formatLocalized('%e/%b/%Y') }}</td>
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
        $('#posts').DataTable({
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
