@extends('backend.layouts.app')

@section('page_title', 'Sub category')

@section('page_sub_title', 'create')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                       {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card-header">
                    <h3>Create sub category</h3>
                </div>
                <div class="card-body">
                    @include('backend.modules.sub_category.form')
                    <a href="{{ route('sub-category.index') }}" class="btn btn-info mt-2">Back</a>
                </div>
            </div>

        </div>
    </div>

    @push('js')
        <script type="text/javascript">
            $('#sub_category_name').on('input', function() {
                let name = $(this).val()
                let slug = name.replaceAll(' ', '-');
                $('#slug').val(slug.toLowerCase())
            });
        </script>
    @endpush

@endsection
