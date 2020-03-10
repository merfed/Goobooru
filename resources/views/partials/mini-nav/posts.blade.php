<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex flex-auto secondary-nav">
        <a href="{{ route('posts') }}" class="{{ request()->is('posts') ? 'active' : '' }}">List</a>
        <a href="{{ route('upload') }}" class="{{ request()->is('posts/upload') ? 'active' : '' }}">Upload</a>
        <a href="{{ route('hotPosts') }}" class="{{ request()->is('posts/hot') ? 'active' : '' }}">Hot</a>
        <a href="{{ route('random') }}" class="{{ request()->is('posts/random') ? 'active' : '' }}">Random</a>
        <a href="#">Saved Searches</a>
        <a href="{{ route('urlPosts') }}" class="{{ request()->is('posts/urls') ? 'active' : '' }}">URLs</a>
        <a href="{{ route('tos') }}" class="{{ request()->is('posts/tos') ? 'active' : '' }}">TOS</a>
        <a href="{{ route('dcma') }}" class="{{ request()->is('posts/dcma') ? 'active' : '' }}">DCMA</a>
        <a href="#">Help</a>
    </nav>

    <nav class="d-flex secondary-nav">
        <a href="{{ route('queue') }}">Queue</a>
    </nav>
</div>
