@extends('backend.layouts.master')
@section('page_title', 'Tag')
@section('page_sub_title', 'Dashboard')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Tag List</h4>
                    <a href="{{ route('tag.create') }}"><button class="btn btn-success btn-sm">+ Add</button></a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Serial</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp

                            @foreach ($tag as $row)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->slug }}</td>
                                    <td>{{ $row->order_by }}</td>
                                    <td>{{ $row->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $row->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $row->updated_at != $row->created_at ? $row->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('tag.show', $row->id) }}">
                                                <button class="btn btn-info btn-sm"> <i
                                                        class="fa-solid fa-eye"></i></button></a>

                                            <a href="{{ route('tag.edit', $row->id) }}">
                                                <button class="btn btn-warning btn-sm mx-1"> <i
                                                        class="fa-solid fa-edit"></i></button></a>

                                            {!! Form::open(['method' => 'delete', 'id' => 'form_' . $row->id, 'route' => ['tag.destroy', $row->id]]) !!}
                                            {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                                'type' => 'button',
                                                'data-id' => $row->id,
                                                'class' => 'delete btn btn-danger btn-sm',
                                            ]) !!}
                                            {!! Form::close() !!}

                                            {{-- <form action="{{ route('category.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                            </form> --}}

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

    @if (session('msg'))
        @push('js')
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "{{ session('cls')}}",
                    toast: true,
                    title: "{{ session('msg')}}",
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endpush
    @endif

    @push('js')
        <script>
            $('.delete').on('click', function() {
                let id = $(this).attr('data-id')
                // console.log(id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#form_${id}`).submit()
                    }
                });
            })


            $('#name').on('input', function() {
                let name = $(this).val()
                let slug = name.replaceAll(' ', '-')
                $('#slug').val(slug.toLowerCase());
            })
        </script>
    @endpush
@endsection
