@extends('backend.layouts.app')

@section('page_title', 'Post')

@section('page_sub_title', 'create')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                       {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card-header">
                    <h3>Create post</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label text-capitalize">Post title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" id="title"
                                aria-describedby="title" placeholder="Post title">
                            @error('title')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class=" col-md-6 mb-3">
                                <label for="category_id" class="form-label text-capitalize">Select category</label>
                                <select name="category_name" id="category_id" class="form-select">
                                    <option value="" selected>Select category</option>
                                    @foreach($categories as $id => $category_name)
                                    <option value="{{ $id }}">{{ $category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sub_category_id" class="form-label text-capitalize">Select sub category</label>
                                <select name="sub_category_name" id="sub_category_id" class="form-select">
                                   <option value="">Select sub category</option>
                                </select>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="post_status" class="form-label text-capitalize">Post Status</label>
                            <select name="post_status" id="post_status" class="form-select">
                                <option value="">Select post status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success text-capitalize">Create post</button>
                    </form>
                    <a href="{{ route('post.index') }}" class="btn btn-info mt-2">Back</a>
                </div>
            </div>

        </div>
    </div>

    @push('js')
        <script type="text/javascript">
            $('#category_id').on('change', function(){
                let category_id = $(this).val();
                let sub_categories
                $('#sub_category_id').empty()
                axios.get(window.location.origin+'/dashboard/get-subcategory/'+category_id).then(res=>{
                    sub_categories = res.data
                    sub_categories.map((sub_category  , index)=>(
                        $('#sub_category_id').append(`<option value=" ${sub_category.id }"> ${sub_category.sub_category_name}</option>`)
                    ))
                })
            })
        </script>
    @endpush

@endsection
