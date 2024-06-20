@extends('backend.layouts.master')
@section('page_title', 'Tag')
@section('page_sub_title', 'Details')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>tag details </h4>
                    <a href="{{ route('tag.index') }}"><button class="btn btn-success btn-sm">Back</button></a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col">Id</th>
                                <td>{{ $tag->id }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Name</th>
                                <td>{{ $tag->name }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Slug</th>
                                <td>{{ $tag->slug }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Serial</th>
                                <td>{{ $tag->order_by }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Status</th>
                                <td>{{ $tag->status }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Created_at</th>
                                <td>{{ $tag->created_at->toDayDateTimeString() }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Updated_at</th>
                                <td>{{ $tag->updated_at != $tag->updated_at ? $tag->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
