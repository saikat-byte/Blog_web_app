@extends('backend.layouts.app')

@section('page_title', 'Category')

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
                    <h3>Create List</h3>
                    <a href="{{ route('category.create') }}"> <button class="btn btn-success">Add</button> </a>
                </div>

            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Category name</th>
                            <th>Slug name</th>
                            <th>Order by</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->slug_name}}</td>
                            <td>{{ $category->order_by }}</td>
                            <td>{{ $category->status }}</td>
                            <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($category->updated_at)->format('d-m-Y') }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('category.show', $category->id ) }}"> <button
                                            class="btn btn-info btn-sm mx-1"> <i class="fa-solid fa-eye"></i> </button>
                                    </a>
                                    <a href="{{ route('category.edit', $category->id ) }}"> <button
                                            class="btn btn-warning btn-sm mx-1"> <i class="fa-solid fa-edit"></i>
                                        </button> </a>

                                        <form action="{{ route('category.destroy', $category->id ) }}" method='POST' id="form_{{ $category->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                              type="button"  data_id="{{ $category->id }}" class="delete btn btn-danger btn-sm mx-1"> <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
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

    </script>
@endpush

@endsection
