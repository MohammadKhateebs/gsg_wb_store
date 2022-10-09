@extends('layouts.dashboard')
{{--  when we use section of simple use this   --}}
@section('title','order')
@section('breadcrumb')
{{--  use @parent to add the view content to layout content  --}}
@parent
<li class="breadcrumb-item active">order</li>
@endsection
 @section('content')


<!-- /.content -->
@endsection
