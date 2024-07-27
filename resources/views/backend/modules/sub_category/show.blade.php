@extends('backend.layouts.app')

@section('page_title', 'Sub category')

@section('page_sub_title', 'Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-sm">
        <div class="card">
            <div class="card-header">
                <h3>Sub category details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $subCategory->id }}</td>
                        </tr>
                        <tr>
                            <th>Sub category name</th>
                            <td>{{ $subCategory->sub_category_name }}</td>
                        </tr>
                        <tr>
                            <th>Category name</th>
                            <td>{{ $subCategory->category->category_name }}</td>
                        </tr>
                        <tr>
                            <th>Slug name</th>
                            <td>{{ $subCategory->slug_name}}</td>
                        </tr>
                        <tr>

                            <th>Order by</th>
                            <td>{{ $subCategory->order_by }}</td>
                        </tr>
                        <tr>

                            <th>Status</th>
                            <td>{{ $subCategory->status }}</td>
                        </tr>
                        <tr>

                            <th>Created at</th>
                            <td>{{ \Carbon\Carbon::parse($subCategory->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>

                            <th>Updated at</th>
                            <td>{{\Carbon\Carbon::parse($subCategory->updated_at)->format('d-m-Y') }}</td>
                        </tr>
                    <tbody>

                </table>
                <a href="{{ route('sub-category.index') }}" class="btn btn-info mt-2">Back</a>
            </div>
        </div>

    </div>
</div>

@endsection
