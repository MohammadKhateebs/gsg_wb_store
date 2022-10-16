@extends('layouts.dashboard')
@section('title','Edite')
@section('breadcrumb')
    {{--  use @parent to add the view content to layout content  --}}
    @parent
    <li class="breadcrumb-item ">products</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')

<form action="{{ route('dashboard.products.update',$products->id) }}" method="post" enctype="multipart/form-data">

    {{--  Form Method Spoofing  --}}
    {{--  <input type="hidden" name="_method" value="put">  --}}
    @method('put')
         @include('dashboard.products._form',[
            'button'=>'Update',
         ])
</form>

@endsection
