@extends('backend.layouts.master')
@section('page_title', 'Tag')
@section('page_sub_title', 'Create')

@section('content')
    <div class="row justify-content-center"> 
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Create Tag</h4>
                    <a href="{{ route('tag.index') }}"><button class="btn btn-success btn-sm mt-2">Back</button></a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(['method' => 'post', 'route' => 'tag.store']) !!}
                    @include('backend.modules.tag.form')
                    {!! Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-success btn-sm mt-2']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $('#name').on('input', function() {
                let name = $(this).val()
                let slug = name.replaceAll(' ', '-')
                $('#slug').val(slug.toLowerCase());
            })
        </script>
    @endpush
@endsection
