@extends('backend.layouts.app')

@section('page_title', 'Category')

@section('page_sub_title', 'Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-sm">
        <div class="card">
            <div class="card-header">
                <h3>Category details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Category name</th>
                            <td>{{ $category->category_name }}</td>
                        </tr>
                        <tr>
                            <th>Slug name</th>
                            <td>{{ $category->slug_name}}</td>
                        </tr>
                        <tr>

                            <th>Order by</th>
                            <td>{{ $category->order_by }}</td>
                        </tr>
                        <tr>

                            <th>Status</th>
                            <td>{{ $category->status }}</td>
                        </tr>
                        <tr>

                            <th>Created at</th>
                            <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>

                            <th>Updated at</th>
                            <td>{{\Carbon\Carbon::parse($category->updated_at)->format('d-m-Y') }}</td>
                        </tr>
                    <tbody>

                </table>
                <a href="{{ route('category.index') }}" class="btn btn-info mt-2">Back</a>
            </div>
        </div>

    </div>
</div>

@endsection
