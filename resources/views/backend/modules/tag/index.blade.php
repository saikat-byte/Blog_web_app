@extends('backend.layouts.app')

@section('page_title', 'Tag')

@section('page_sub_title', 'List')

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
                    <h3>Tag List</h3>
                    <a href="{{ route('tag.create') }}"> <button class="btn btn-success">Add</button> </a>
                </div>

            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Tag name</th>
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
                        @foreach($tags as $key => $tag)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $tag->tag_name }}</td>
                            <td>{{ $tag->slug_name}}</td>
                            <td>{{ $tag->order_by }}</td>
                            <td>{{ $tag->status }}</td>
                            <td>{{ \Carbon\Carbon::parse($tag->created_at)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($tag->updated_at)->format('d-m-Y') }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('tag.show', $tag->id ) }}"> <button
                                            class="btn btn-info btn-sm mx-1"> <i class="fa-solid fa-eye"></i> </button>
                                    </a>
                                    <a href="{{ route('tag.edit', $tag->id ) }}"> <button
                                            class="btn btn-warning btn-sm mx-1"> <i class="fa-solid fa-edit"></i>
                                        </button> </a>

                                        <form action="{{ route('tag.destroy', $tag->id ) }}" method='POST' id="form_{{ $tag->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                              type="button"  data_id="{{ $tag->id }}" class="delete btn btn-danger btn-sm mx-1"> <i class="fa-solid fa-trash"></i>
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
