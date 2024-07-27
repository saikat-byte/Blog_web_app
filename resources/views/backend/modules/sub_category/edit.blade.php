@extends('backend.layouts.app')

@section('page_title', 'Sub category')

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
                <h3>Update sub category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('sub-category.update', $subCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="sub_category_name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('sub_category_name') is-invalid @enderror"
                            name="sub_category_name" value="{{ $subCategory->sub_category_name }}"
                            id="sub_category_name" aria-describedby="sub_category_name" placeholder="Sub category name">
                        @error('sub_category_name')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug_name') is-invalid @enderror"
                            name="slug_name" value="{{ $subCategory->slug_name }}" id="slug"
                            aria-describedby="slug_name" placeholder="Slug name">
                        @error('slug_name')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Select category</label>
                        <select name="category_id" id="category" class="form-select">
                            <option value="">Select category </option>
                            @foreach($categories as $id => $category_name)
                            <option value="{{ $id }}" {{ $subCategory->category_id == $id ? 'selected' : '' }}>
                                {{ $category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="order_by" class="form-label">sub category serial</label>
                        <input type="slug" class="form-control @error('order_by') is-invalid @enderror" name="order_by"
                            value="{{ $subCategory->order_by }}" id="order_by" aria-describedby="order_by"
                            placeholder="Sub category serial">
                        @error('order_by')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Sub category Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Select status</option>
                            <option value="1" {{ $subCategory->status == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $subCategory->status == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update sub category</button>
                </form>

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
