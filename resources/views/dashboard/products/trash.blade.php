@extends('layouts.dashboard')
@section('title', 'Trashed Item')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">products</li>
    <li class="breadcrumb-item active">Trashed</li>
@endsection
@section('content')
    <div class="table-toolbar mb-2">
        <a href="{{ route('dashboard.products.index') }}" class="btn btn-light btn-sm">Go Back</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Deleted At</th>
                    <th>description</th>
                    <th>Image</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->deleted_at }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ Storage::disk('uploads')->url($item->image) }}" alt="" height="60">
                            @else
                                <img src="{{ asset('uploads/default-thumbnail.jpg') }}" alt="" height="60">
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('dashboard.products.restore', $item->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-outline-light">Restore</button>

                            </form>
                        </td>
                        <td>
                        <form action="{{ route('dashboard.products.destroy', $item->id) }}" method="post">
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
@endsection
