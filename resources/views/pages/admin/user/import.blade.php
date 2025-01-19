@extends('../../layouts.admin')

@section('title','Import Users')

@section('admin-content')
<div class="user-import">
    <span class="user-import-note">Please use this <a href="{{ route('download_template')}}">File</a> as template for your import. </span>
    <form action="{{route('import_user')}}" class="user-import-form" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" class="user-import-file" name="file_import" id="file_import"/>
        <button type="submit" class="button w-2 text-center">import</button>
    </form>
</div>
@endsection

@section('footer')
    <a class="button w-5 text-center" href="{{ route('admin_user')}}">
        Go Back
    </a>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#user-menu-item').css('background-color', '#62B485');
        const inputElement = document.querySelector('#file_import');
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        const pond = FilePond.create(inputElement, {
            acceptedFileTypes: ['text/csv'],
            fileValidateTypeDetectType: (source, type) =>
            new Promise((resolve, reject) => {
                if (window.navigator.platform.indexOf('Win') > -1) {
                    if (type === 'application/vnd.ms-excel') type = 'text/csv'
                }
                resolve(type);
            }),
            server: {
                process: '{{ route('upload') }}',
                revert: '{{ route('revert') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    });
</script>
@endsection