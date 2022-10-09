@extends('layouts.dashboard')
@section('title','Edite')
@section('breadcrumb')
    {{--  use @parent to add the view content to layout content  --}}
    @parent
    <li class="breadcrumb-item ">Categories</li>
    <li class="breadcrumb-item active">Edite</li>
@endsection
@section('content')

<form action="{{ route('dashboard.categories.update',$category->id) }}" method="post">
    @csrf
    {{--  Form Method Spoofing  --}}
    {{--  <input type="hidden" name="_method" value="put">  --}}
    @method('put')
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" value="{{ $category->name }}" class="form-control" >
            </div>
            <div class="form-group mb-3">
                <label for="parent_id">Parent ID</label>
                <select type="text" id="parent_id" name="parent_id" class="form-control" >
                    @foreach ($parents as $parent)

                    <option value="{{ $parent->id }}" @if($parent->id == $category->id) selected @endif >{{ $parent->name }}</option>



                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="description">Category Description</label>
                <textarea type="text" id="description" name="description" class="form-control" >
                    {{ $category->description }}
                </textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label for="image">Thumbnail</label>
                <input type="file" id="iamge" name="iamge" class="form-control" >
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit"  class="btn btn-primary" >save</button>
                <a href="{{ route('dashboard.categories.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </div>
    </div>



</form>

@endsection
