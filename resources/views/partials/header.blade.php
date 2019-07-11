<div class="header d-flex flex-items-center">
    <div class="logo">
        <a href="/"><img src="/imgs/logo.png" alt=""></a>
    </div>

    <nav class="nav d-flex flex-auto">
        <a href="{{ route('posts') }}" class="{{ (request()->is('posts*') || request()->is('posts/*')) ? 'active' : '' }}">Posts</a>
        <a href="{{ route('tags') }}" class="{{ (request()->is('tags') || request()->is('tags/*')) ? 'active' : '' }}">Tags</a>
        <a href="{{ route('pools') }}" class="{{ (request()->is('pools') || request()->is('pools/*')) ? 'active' : '' }}">Pools</a>
        <a href="#" class="{{ request()->is('notes') ? 'active' : '' }}">Notes</a>
        <a href="#" class="{{ request()->is('comments') ? 'active' : '' }}">Comments</a>
        <a href="#" class="{{ request()->is('wiki') ? 'active' : '' }}">Wiki</a>
        <a href="#" class="{{ request()->is('forum') ? 'active' : '' }}">Forum</a>
    </nav>

    <a href="#" class="login">Login</a>
</div>

@if (! isset($type))

@elseif ($type == 'notes')
<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex seconday-nav">
        <a href="#">List</a>
        <a href="#">Posts</a>
        <a href="#">History</a>
        <a href="#">Requests</a>
        <a href="#">Help</a>
    </nav>
</div>
@elseif ($type == 'wiki')
<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex seconday-nav">
        <a href="#">Listing</a>
        <a href="#">Help</a>
        <a href="#">History</a>
    </nav>
</div>
@elseif ($type == 'account')
<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex seconday-nav">
        <a href="#">Home</a>
        <a href="#">Profile</a>
        <a href="#">Mail</a>
        <a href="#">Favorites</a>
        <a href="#">Options</a>
    </nav>
</div>
@elseif ($type == 'comments')
<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex seconday-nav">
        <a href="#">List</a>
        <a href="#">Help</a>
    </nav>
</div>
@endif
