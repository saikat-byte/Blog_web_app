@extends('backend.layouts.app')

@section('page_title', 'Post')

@section('page_sub_title', 'list')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-sm">
        @if (session()->has('success'))
        <div class="alert alert-danger">
            {{ session()->get('success') }}
        </div>
        @endif
        <div class="card">

            <div class="card-header">
                <div class=" d-flex justify-content-between">
                    <h3>Post List</h3>
                    <a href="{{ route('post.create') }}"> <button class="btn btn-success">Add</button> </a>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover post_table">
                        <thead>
                            <tr>
                                <th class="text-center">Sl</th>
                                <th class="text-center">
                                    <p>Post title</p>
                                    <hr>
                                    <p>Slug name</p>
                                </th>
                                <th class="text-center">
                                    <p>Category name</p>
                                    <hr>
                                    <p>Sub category name</p>
                                </th>
                                <th class="text-center">
                                    <p>Status</p>
                                    <hr>
                                    <p>Is approved</p>
                                </th>
                                <th class="text-center">Photo</th>
                                <th class="text-center">
                                    <p>Created at</p>
                                    <hr>
                                    <p>Updated at</p>
                                    <hr>
                                    <p>Created by</p>

                                </th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sl = 1;
                            @endphp
                            @foreach($posts as $key => $post)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>
                                    <p>{{ $post->title }}</p>
                                    <hr>
                                    <p>{{ $post->slug}}</p>
                                </td>
                                <td>
                                    <p>{{ $post->category->category_name }}</p>
                                    <hr>
                                    <p>{{ $post->subCategory->sub_category_name}}</p>
                                </td>

                                <td>
                                    <p>{{ $post->status == 1 ? "Published" : "Not published" }}</p>
                                    <hr>
                                    <p>{{ $post->is_approved == 1 ? "Approved" : "Not approved" }}</p>
                                </td>
                                <td>
                                    <img  class="img-thumbnail post_image" data-src="{{ asset('image/post/original/'.$post->photo) }}" src="{{ asset('image/post/thumbnail/'.$post->photo) }}" alt="{{ $post->photo }}">
                                </td>
                                <td>
                                    <p>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y')}}</p>
                                    <hr>
                                    <p>{{ $post->created_at != $post->updated_at ? \Carbon\Carbon::parse($post->updated_at)->format('d-m-Y') : "Not updated" }}</p>
                                    <hr>
                                    <p class="fw-bold">{{ $post->user?->name}}</p>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('post.show', $post->id ) }}"> <button
                                                class="btn btn-info btn-sm mx-1"> <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('post.edit', $post->id ) }}"> <button
                                                class="btn btn-warning btn-sm mx-1"> <i class="fa-solid fa-edit"></i>
                                            </button> </a>

                                        <form action="{{ route('post.destroy', $post->id ) }}" method='POST'
                                            id="form_{{ $post->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data_id="{{ $post->id }}"
                                                class="delete btn btn-danger btn-sm mx-1"> <i
                                                    class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class=" d-flex mt-4">
                        {{ $posts->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Blog image</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img  class="img-thumbnail" alt="Display image" id="display_image" />
        </div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal -->
<button type="button" id="image_show_button"  class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#image_show"></button>

</div>

@push('js')
<script type="text/javascript">
    $('.delete').on('click', function(){
       let id = $(this).attr('data_id');
       Swal.fire({
        title: "Are you sure to delete?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            $(`#form_${id}`).submit()
            Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
            });
        }
        });

    });

    $('.post_image').on('click', function(){

        let img = $(this).attr('data-src')
        $('#display_image').attr('src', img)

        $('#image_show_button').trigger('click')

    })

</script>
@endpush

@endsection
