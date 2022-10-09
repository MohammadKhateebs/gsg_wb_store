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

    {{--  Form Method Spoofing  --}}
    {{--  <input type="hidden" name="_method" value="put">  --}}
    @method('put')
         @include('dashboard.categories._form',[
            'button'=>'Update',
         ])
</form>

@endsection
