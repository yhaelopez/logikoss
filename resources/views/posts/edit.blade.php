@extends('layouts.dashboard')

@section('main')
<div class="container-fluid">
    <div class="container py-4">

        <div class="row">
            <div class="col-12">
                <p class="h3 text-center">@lang('new.post')</p>
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-12 col-md-6">

                @include('posts.utils.post-form', [
                    'ruta' => route('posts.update', ['post' => $post]),
                    'method' => 'PATCH'
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
<script src="https://cdn.tiny.cloud/1/{{ config('tiny-cloud.apikey') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      height: 500,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
  </script>
@endsection
