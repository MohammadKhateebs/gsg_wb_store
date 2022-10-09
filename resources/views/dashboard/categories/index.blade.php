@extends('layouts.dashboard')
{{--  when we use section of simple use this   --}}
@section('title', $title)
@section('breadcrumb')
    {{--  use @parent to add the view content to layout content  --}}
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')
<div class="table-toolbar mb-3">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">Add New</a>
</div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Created At</th>
                    <th>Image</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enteries as $item)
                    <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->parent_id }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->image}}</td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit',$item->id) }}" class="btn btn-success">Edite</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy',$item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>

                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- /.content -->
@endsection
