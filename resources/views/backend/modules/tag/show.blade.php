@extends('backend.layouts.app')

@section('page_title', 'tag')

@section('page_sub_title', 'Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-sm">
        <div class="card">
            <div class="card-header">
                <h3>tag details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $tag->id }}</td>
                        </tr>
                        <tr>
                            <th>tag name</th>
                            <td>{{ $tag->tag_name }}</td>
                        </tr>
                        <tr>
                            <th>Slug name</th>
                            <td>{{ $tag->slug_name}}</td>
                        </tr>
                        <tr>

                            <th>Order by</th>
                            <td>{{ $tag->order_by }}</td>
                        </tr>
                        <tr>

                            <th>Status</th>
                            <td>{{ $tag->status }}</td>
                        </tr>
                        <tr>

                            <th>Created at</th>
                            <td>{{ \Carbon\Carbon::parse($tag->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>

                            <th>Updated at</th>
                            <td>{{\Carbon\Carbon::parse($tag->updated_at)->format('d-m-Y') }}</td>
                        </tr>
                    <tbody>

                </table>
                <a href="{{ route('tag.index') }}" class="btn btn-info mt-2">Back</a>
            </div>
        </div>

    </div>
</div>

@endsection
