@extends('layouts.dashboard')

@section('main')
<div class="container-fluid">
    <div class="container py-4">

        <div class="row">
            <div class="col-12">
                <p class="h3 text-center">@lang('new.user')</p>
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-12 col-md-6">

                @include('users.utils.user-form', [
                    'ruta' => route('users.store', [
                        'roles' => $roles
                    ])
                ])

            </div>

        </div>

    </div>

</div>
@endsection

@section('js')
<script>
    window.onload = (e) => {
        // Get a reference to the file input element
        const fileInput = document.querySelector('input[id="filepond"]');
        // Create a FilePond instance
        const filepondConf = FilePond.create(fileInput, {
            acceptedFileTypes: ['image/*'],
        });


        FilePond.setOptions({
            server: {
                url: `{{ route('api.v1.upload') }}`,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });

    };
</script>
@endsection
