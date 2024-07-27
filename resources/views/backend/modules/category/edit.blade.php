@extends('backend.layouts.app')

@section('page_title', 'Category')

@section('page_sub_title', 'Update')

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
                    <h3>Update category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                name="category_name" value="{{ $category->category_name }}" id="category_name"
                                aria-describedby="category_name" placeholder="Category name">
                            @error('category_name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug_name') is-invalid @enderror" name="slug_name"
                                value="{{ $category->slug_name }}" id="slug" aria-describedby="slug_name"
                                placeholder="Slug name">
                            @error('slug_name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="order_by" class="form-label">category serial</label>
                            <input type="slug" class="form-control @error('order_by') is-invalid @enderror"
                                name="order_by" value="{{ $category->order_by }}" id="order_by"
                                aria-describedby="order_by" placeholder="category serial">
                            @error('order_by')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Category Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update category</button>

                    </form>
                    <a href="{{ route('category.index') }}" class="btn btn-info mt-2">Back</a>
                </div>
            </div>

        </div>
    </div>

    @push('js')
        <script type="text/javascript">
            $('#category_name').on('input', function() {
                let name = $(this).val()
                let slug = name.replaceAll(' ', '-');
                $('#slug').val(slug.toLowerCase())
            });
        </script>
    @endpush

@endsection
