@extends('backend.layouts.app')

@section('page_title', 'Post')

@section('page_sub_title', 'edit')

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
                <h3>Edit post</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label badge bg-primary text-capitalize">Post title</label>
                        <input type="text" id="post_title" class="form-control @error('title') is-invalid @enderror"
                            name="title" value="{{ old('title', $post->title) }}" id="title" aria-describedby="title"
                            placeholder="Post title">
                        @error('title')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                            name="slug" value="{{ old('slug',$post->slug) }}" id="slug" aria-describedby="slug_name" placeholder="Slug name">
                        @error('slug')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class=" col-md-6 mb-3">
                            <label for="category_id" class="form-label badge bg-primary text-capitalize">Select category</label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="" selected>Select category</option>
                                @foreach($categories as $id => $category_name)
                                <option value="{{ $id }}" {{ $post->category_id == $id ? 'selected' : '' }} >{{ $category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sub_category_id" class="form-label badge bg-primary text-capitalize">Select sub category</label>
                            <select name="sub_category_id" id="sub_category_id" class="form-select @error('sub_category_id') is-invalid @enderror">
                                <option value="" selected>Select category</option>
                                @foreach($subCategories as $id => $subCategory_name)
                                <option value="{{ $id }}" {{ $post->sub_category_id == $id ? 'selected' : '' }}>
                                    {{ $subCategory_name }}
                                </option>
                            @endforeach
                            </select>
                            @error('sub_category_id')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label badge bg-primary text-capitalize">Post description</label>
                        <textarea id="description" class="form-control  @error('description') is-invalid @enderror"
                            name="description" placeholder="write something...">{{ old('description', $post->description) }}</textarea>
                        @error('description')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label badge bg-primary text-capitalize">Select Tags</label>
                        <div class="row">
                            @foreach($tags as $tag)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" name="tag_name_ids[]" type="checkbox"
                                               id="form_{{ $tag->id }}" value="{{ $tag->id }}"
                                               {{ in_array($tag->id, old('tag_name_ids', $post->tag->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="form_{{ $tag->id }}">
                                            {{ $tag->tag_name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label badge bg-primary text-capitalize">Upload Photo</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                               name="photo" id="photo" value="{{ $post->photo }}">
                        @error('photo')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror

                        @if($post->photo)
                        <div class="mt-3">
                            <img src="{{ asset('image/post/original/' . $post->photo) }}" alt="Post Photo" style="max-width: 300px; max-height: 300px;">
                        </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="post_status" class="form-label badge bg-primary text-capitalize">Post Status</label>
                        <select name="status" id="post_status" class="form-select @error('status') is-invalid @enderror">
                            <option value="">Select Post Status</option>
                            <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success text-capitalize">Update post</button>
                </form>
                <a href="{{ route('post.index') }}" class="btn btn-primary mt-2">Back</a>
            </div>
        </div>
    </div>
</div>
@push('css')
<style>
    .ck.ck-editor__main>.ck-editor__editable {
        border-color: var(--ck-color-base-border);
        min-height: 250px;
    }
</style>
@endpush
@push('js')
{{-- axios cdn link to use get sub category by category Id --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
    integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- ckeditor cdn link --}}
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css" />

<script type="importmap">
    {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
            }
        }
    </script>

<script type="module">
    import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create( document.querySelector( '#description' ), {
                plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                }
            } )
            .then( /* ... */ )
            .catch( /* ... */ );
</script>


<script type="text/javascript">
    $('#category_id').on('change', function(){
                let category_id = $(this).val();
                let sub_category_element = $('#sub_category_id')
                sub_category_element.empty()
                sub_category_element.append('<option selected="selected">Select sub category</option>')

                axios.get(window.location.origin+'/dashboard/get-subcategory/'+category_id).then(res=>{
                   let sub_categories = res.data
                    sub_categories.map((sub_category  , index)=>(
                        sub_category_element.append(`<option value=" ${sub_category.id }"> ${sub_category.sub_category_name}</option>`)
                    ))
                })
            })

        $('#post_title').on('input', function() {
        let name = $(this).val()
        let slug = name.replaceAll(' ', '-');
        $('#slug').val(slug.toLowerCase())
    });


</script>

@endpush

@endsection
