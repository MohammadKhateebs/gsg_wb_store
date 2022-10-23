@props(['name'=>'success','class'=>'success '])


@if (session()->has($name))
<div class="alert alert-{{ $class ?? 'success'}} alert-dismissible fade show" role="alert">
    {{ session()->get($name) }}
    <button type="button" class="close " data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@push('script')
    <script>
        window.setTimeout(function() {
            $('.alert').alert('close');

        }, 5000);
    </script>
@endpush
