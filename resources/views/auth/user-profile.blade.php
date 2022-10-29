@extends('layouts.dashboard')

@section('title','User Profile')
@section('content')


<x-flash-message  />

<a href="{{ route('change-password') }}" class="btn btn-outline-light">Change Password</a>

<form action="{{ route('profile.update') }}" method="post">
@method('patch')
@csrf
<div class="form-group">
<x-form.input name="name" :value="$user->name" label="Name" />
</div>
<div class="form-group">
<x-form.input name="email" :value="$user->email" label="E-mail"/>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary">Save</button>
</div>

</form>

@endsection
