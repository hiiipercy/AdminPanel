@extends('backend.layouts.master')
@section('page_title', 'Category')
@section('page_sub_title', 'Details')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Category details </h4>
                    <a href="{{ route('category.index') }}"><button class="btn btn-success btn-sm">Back</button></a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col">Id</th>
                                <td>{{ $category->id }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Name</th>
                                <td>{{ $category->name }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Slug</th>
                                <td>{{ $category->slug }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Serial</th>
                                <td>{{ $category->order_by }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Status</th>
                                <td>{{ $category->status }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Created_at</th>
                                <td>{{ $category->created_at->toDayDateTimeString() }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Updated_at</th>
                                <td>{{ $category->updated_at != $category->updated_at ? $category->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
