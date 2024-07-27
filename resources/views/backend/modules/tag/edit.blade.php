@extends('backend.layouts.app')

@section('page_title', 'Tag')

@section('page_sub_title', 'update')

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
                    <h3>Update tag</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('tag.update', $tag) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tag_name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('tag_name') is-invalid @enderror"
                                name="tag_name" value="{{ $tag->tag_name }}" id="tag_name"
                                aria-describedby="tag_name" placeholder="tag name">
                            @error('tag_name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug_name') is-invalid @enderror" name="slug_name"
                                value="{{ $tag->slug_name }}" id="slug" aria-describedby="slug_name"
                                placeholder="Slug name">
                            @error('slug_name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="order_by" class="form-label">Tag serial</label>
                            <input type="slug" class="form-control @error('order_by') is-invalid @enderror"
                                name="order_by" value="{{ $tag->order_by }}" id="order_by"
                                aria-describedby="order_by" placeholder="tag serial">
                            @error('order_by')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Tag Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update tag</button>

                    </form>
                    <a href="{{ route('tag.index') }}" class="btn btn-info mt-2">Back</a>
                </div>
            </div>

        </div>
    </div>

    @push('js')
        <script type="text/javascript">
            $('#tag_name').on('input', function() {
                let name = $(this).val()
                let slug = name.replaceAll(' ', '-');
                $('#slug').val(slug.toLowerCase())
            });
        </script>
    @endpush

@endsection
