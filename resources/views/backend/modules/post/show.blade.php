@extends('backend.layouts.app')

@section('page_title', 'Post details')

@section('page_sub_title', 'Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-sm">
        <div class="card">
            <div class="card-header">
                <h3>Post details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>Id</th>
                            <td>{{ $post->id }}</td>
                        </tr>
                        <tr>
                            <th>Post title</th>
                            <td>{{ $post->title }}</td>
                        </tr>
                        <tr>
                            <th>Slug name</th>
                            <td>{{ $post->slug}}</td>
                        </tr>
                        <tr>
                            <th>Is Approved</th>
                            <td>{{ $post->is_approved == 1 ? "Approved" : "Not Approved" }}</td>
                        </tr>
                        <tr>

                            <th>Description</th>
                            <td>{!! $post->description !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $post->status == 1 ? "Published" : "Not published" }}</td>
                        </tr>
                        <tr>
                            <th>Admin comment</th>
                            <td>{{ $post->admin_comment }}</td>
                        </tr>
                        <tr>
                            <th>Photo</th>
                            <td>
                                <img class="img-thumbnail post_image"
                                    data-src="{{ asset('image/post/original/'.$post->photo) }}"
                                    src="{{ asset('image/post/thumbnail/'.$post->photo) }}" alt="{{ $post->photo }}">
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td>
                                @php
                                $classes = ['text-bg-primary', 'text-bg-secondary', 'text-bg-dark', 'text-bg-danger', 'text-bg-warning', 'text-bg-info', ' text-bg-success']
                            @endphp

                            @foreach ($post->tag as $tag)

                               <a href="{{ route('tag.show', $tag->id) }}"> <span class="badge py-2  {{ $classes[random_int(0,6)] }} "> {{ $tag->tag_name }}</span></a>

                            @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Deleted at</th>
                            <td>{{ $post->deleted_at != null ? \Carbon\Carbon::parse($post->deleted_at)->format('d-m-Y')
                                : "Not deleted" }}</td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{ $post->updated_at != $post->created_at ?
                                Carbon\Carbon::parse($post->updated_at)->format('d-m-Y') : "Not updated"}}</td>
                        </tr>
                    <tbody>
                </table>
                <a href="{{ route('post.index') }}" class="btn btn-info mt-2">Back</a>
            </div>
        </div>

    </div>
    <div class="col-md-4 col-sm">
        <div class="card">
            <div class="card-header">
                <h3>Category details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tbody>
                        <tr>
                            <th>Category Id</th>
                            <td>{{ $post->category?->id }}</td>
                        </tr>
                        <tr>
                            <th>Category name</th>
                            <td>{{ $post->category?->category_name }}</td>
                        </tr>
                        <tr>
                            <th>Slug name</th>
                            <td>{{ $post->category?->slug_name }}</td>
                        </tr>
                        <tr>
                            <th>Order by</th>
                            <td>{{ $post->category?->order_by }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $post->category?->status == 1 ? 'Active' : "Inactive" }}</td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{ \Carbon\Carbon::parse($post->category?->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{ $post->updated_at != $post->created_at ?
                                Carbon\Carbon::parse($post->category?->updated_at)->format('d-m-Y') : "Not updated"}}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('category.show', $post->category->id) }}" class="btn btn-info mt-2">Details</a>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h3>Sub category details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tbody>
                        <tr>
                            <th>Sub category Id</th>
                            <td>{{ $post->subCategory?->id }}</td>
                        </tr>
                        <tr>
                            <th>Sub category name</th>
                            <td>{{ $post->subCategory?->category_name }}</td>
                        </tr>
                        <tr>
                            <th>Slug name</th>
                            <td>{{ $post->subCategory?->slug_name }}</td>
                        </tr>
                        <tr>
                            <th>Order by</th>
                            <td>{{ $post->subCategory?->order_by }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $post->subCategory?->status == 1 ? 'Active' : "Inactive" }}</td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{ \Carbon\Carbon::parse($post->subCategory?->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{ $post->updated_at != $post->created_at ?
                                Carbon\Carbon::parse($post->subCategory?->updated_at)->format('d-m-Y') : "Not updated"}}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('sub-category.show', $post->subCategory->id) }}" class="btn btn-info mt-2">Details</a>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h3>User details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tbody>
                        <tr>
                            <th>User Id</th>
                            <td>{{ $post->user?->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $post->user?->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $post->user?->email }}</td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{ \Carbon\Carbon::parse($post->user?->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{ $post->updated_at != $post->created_at ?
                                Carbon\Carbon::parse($post->user?->updated_at)->format('d-m-Y') : "Not updated"}}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="#" class="btn btn-info mt-2">Details</a>
            </div>
        </div>
    </div>
</div>

@endsection
