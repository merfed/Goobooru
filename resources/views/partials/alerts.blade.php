@if(Session::has('success'))
<div class="alert alert-success">
    @if (Session::has('success'))
    {!! Session::get('success') !!}
    @else
    {{ session('status') }}
    @endif
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-error">
    {!! Session::get('error') !!}
</div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning">
    {!! Session::get('warning') !!}
</div>
@endif

@if(count($errors))
    @foreach ($errors->all() as $error)
    <div class="alert alert-error">
        {!! $error !!}
    </div>
    @endforeach
@endif
