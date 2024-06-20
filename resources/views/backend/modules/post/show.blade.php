@extends('backend.layouts.master')
@section('page_title', 'Posts')
@section('page_sub_title', 'Details')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Posts details </h4>
                    <a href="{{ route('post.index') }}"><button class="btn btn-success btn-sm">Back</button></a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col">Image</th>
                                <td>
                                    <img data-src="{{ url('image/post/original/'.$posts->image) }}" src="{{ url('image/post/thumb/'.$posts->image) }}" alt="{{ $posts->title }}"  style="height:70px;">
                                </td>
                            </tr>

                            <tr>
                                <th scope="col">Id</th>
                                <td>{{ $posts->id }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Title</th>
                                <td>{{ $posts->title }}</td>
                            </tr>
                         
                            <tr>
                                <th scope="col">Status</th>
                                @php
                                    $status = $posts->status ? 'Active':'Not-active';
                                @endphp
                                <td>{{ $status}}</td>
                            </tr>

                            <tr>
                                <th scope="col">Created_at</th>
                                <td>{{ $posts->created_at->toDayDateTimeString() }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Updated_at</th>
                                <td>{{ $posts->updated_at != $posts->updated_at ? $posts->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
