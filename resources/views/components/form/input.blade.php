@props([
    'id'=>null
    ,'name',
    'type'=>'text',
    'label'=>null ,
    'value'=>'',
    'required' => 0

])

{{--  if no id use name   --}}
 @php
     $id=$id ?: $name;
 @endphp
 @if(isset($label))
 <x-form.label :required="$required">{{ $label }}

 </x-form.label>
 {{--  <label for="{{ $id ?? ''}}">{{ $label }}</label>  --}}

 @endif
<input id="{{ $id }}" name="{{ $name }}" {{$attributes->class(['form-control',"is-invalid"=>$errors->has($name)]) }} value="{{ old('$name', $value) }}"
   {{--  class="form-control    @error($name) is-invalid @enderror"--}}>
@error($name)
    <p class="invalid-feedback">{{ $message }}</p>
@enderror
