<div class="header d-flex flex-items-center">
    <div class="logo">
        <a href="/"><img src="/imgs/logo.png" alt=""></a>
    </div>

    <nav class="nav d-flex flex-auto">
        <a class="active" href="#">Posts</a>
        <a href="#">Tags</a>
        <a href="#">Pools</a>
        <a href="#">Comments</a>
    </nav>

    <a href="#" class="login">Login</a>
</div>

@if (! isset($type))
<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex secondary-nav">
        <a href="#">List</a>
        <a href="{{ route('upload') }}">Upload</a>
        <a href="#">Random</a>
        <a href="#">Saved Searches</a>
        <a href="#">TOS</a>
        <a href="#">DCMA</a>
        <a href="#">Help</a>
    </nav>
</div>
@endif

@if ($type == 'account')
<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex seconday-nav">
        <a href="#">Home</a>
        <a href="#">Profile</a>
        <a href="#">Mail</a>
        <a href="#">Favorites</a>
        <a href="#">Options</a>
    </nav>
</div>
@endif

@if ($type == 'comments')
<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex seconday-nav">
        <a href="#">List</a>
        <a href="#">Help</a>
    </nav>
</div>
@endif

@if ($type == 'tags')
<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex seconday-nav">
        <a href="#">Aliases</a>
        <a href="#">Implications</a>
        <a href="#">List</a>
        <a href="#">Edit</a>
        <a href="#">Saved Searches</a>
    </nav>
</div>
@endif

@if ($type == 'pools')
<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex seconday-nav">
        <a href="#">List</a>
        <a href="#">New</a>
        <a href="#">Help</a>
    </nav>
</div>
@endif
