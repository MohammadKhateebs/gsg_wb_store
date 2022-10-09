@extends('layouts.dashboard')
@section('title', 'Create Categories')
@section('breadcrumb')
    {{--  use @parent to add the view content to layout content  --}}
    @parent
    <li class="breadcrumb-item ">Categories</li>
    <li class="breadcrumb-item active">create</li>
@endsection
@section('content')
    {{--  @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  --}}
    {{--  //if the form have a file type we use enctype="multipart/form-data"
    //the form  --}}
    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @include('dashboard.categories._form',[
            'button'=>'Create',
        ])


    </form>
@endsection
