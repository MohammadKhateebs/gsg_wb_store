@extends('layouts.dashboard')
{{--  when we use section of simple use this   --}}
@section('title', $title)
@section('breadcrumb')
    {{--  use @parent to add the view content to layout content  --}}
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')
{{--  its right way but not components  --}}
 {{--  @include('components.flash-message')  --}}

 <x-flash-message  />

{{--  @php
    $message='hello world !';
@endphp

    @if (session()->has('message'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close " data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>  --}}
    {{--  @php
    Session()->remove('message');
    @endphp
@endif--}}
    <div class="table-toolbar  mb-3 d-flex justify-content-between">
        <div>
            <form action="{{ route('dashboard.categories.index') }}" class="d-flex" method="get">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control">
                <button type="submit" class="btn btn-dark ml-2">search</button>
            </form>
        </div>
        <div>
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary btn-sm">Add New</a>
            <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-danger btn-sm">Trashed</a>

        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Created At</th>
                    <th>description</th>
                    <th>Image</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enteries as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->parent_name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ Storage::disk('uploads')->url($item->image) }}" alt="" height="60">
                            @else
                                <img src="{{ asset('uploads/default-thumbnail.jpg') }}" alt="" height="60">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dashboard.categories.edit', $item->id) }}"
                                class="btn btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.categories.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger">Delete</button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- /.content -->
@endsection


