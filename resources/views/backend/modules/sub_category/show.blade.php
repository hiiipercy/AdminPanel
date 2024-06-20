@extends('backend.layouts.master')
@section('page_title', 'Sub Category')
@section('page_sub_title', 'Details')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Sub Category details </h4>
                    <a href="{{ route('sub-category.index') }}"><button class="btn btn-success btn-sm">Back</button></a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col">Id</th>
                                <td>{{ $subCategory->id }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Name</th>
                                <td>{{ $subCategory->name }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Slug</th>
                                <td>{{ $subCategory->slug }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Category</th>
                                <td>{{ $subCategory->category->name }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Serial</th>
                                <td>{{ $subCategory->order_by }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Status</th>
                                <td>{{ $subCategory->status }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Created_at</th>
                                <td>{{ $subCategory->created_at->toDayDateTimeString() }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Updated_at</th>
                                <td>{{ $subCategory->updated_at != $subCategory->updated_at ? $subCategory->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
