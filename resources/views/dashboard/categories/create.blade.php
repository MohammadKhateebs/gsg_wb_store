@extends('layouts.dashboard')
@section('title','Create Categories')
@section('breadcrumb')
    {{--  use @parent to add the view content to layout content  --}}
    @parent
    <li class="breadcrumb-item ">Categories</li>
    <li class="breadcrumb-item active">create</li>
@endsection
@section('content')
<form action="{{ route('dashboard.categories.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" class="form-control" >
            </div>
            <div class="form-group mb-3">
                <label for="parent_id">Parent ID</label>
                <select type="text" id="parent_id" name="parent_id" class="form-control" >
                    @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="description">Category Description</label>
                <textarea type="text" id="description" name="description" class="form-control" >
                </textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label for="image">Thumbnail<</label>
                <input type="file" id="image" name="image" class="form-control" >
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit"  class="btn btn-primary" >Save</button>
                <a href="{{ route('dashboard.categories.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </div>
    </div>



</form>
@endsection
