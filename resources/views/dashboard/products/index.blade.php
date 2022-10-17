@extends('layouts.dashboard')
{{--  when we use section of simple use this   --}}
@section('title', 'Products')
@section('breadcrumb')
    {{--  use @parent to add the view content to layout content  --}}
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection
@section('content')

<x-flash-message name="success" class="sucsess"/>
{{--  @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif  --}}
    {{--  @if (session()->has('message'))
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
            <form action="{{ route('dashboard.products.index') }}" class="d-flex" method="get">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control">
                <button type="submit" class="btn btn-dark ml-2">search</button>
            </form>
        </div>
        <div>
            <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary btn-sm">Add New</a>
            <a href="{{ route('dashboard.products.trash') }}" class="btn btn-danger btn-sm">Trashed</a>

        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>price</th>
                    <th>Quantity</th>
                    <th>sku</th>
                    <th>status</th>
                    <th>Image</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category_id }}</td>
                        <td>{{ $item->price }}
                            @if($item->compare_price)|
                            <del>
                                {{ $item->compare_price }}
                            </del>
                            @endif
                        </td>



                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->sku }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ Storage::disk('uploads')->url($item->image) }}" alt="" height="60">

                            @else
                                <img src="{{ asset('uploads/default-thumbnail.jpg') }}" alt="" height="60">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dashboard.products.edit', $item->id) }}"
                                class="btn btn-outline-success">Edite</a>
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

    <!-- /.content -->
@endsection

{{--  @push('script')
    <script>
        window.setTimeout(function() {
            $('.alert').alert('close');

        }, 5000);
    </script>
@endpush  --}}
