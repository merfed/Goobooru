<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex secondary-nav">
        <a href="{{ route('posts') }}" class="{{ request()->is('posts') ? 'active' : '' }}">List</a>
        <a href="{{ route('upload') }}" class="{{ request()->is('posts/upload') ? 'active' : '' }}">Upload</a>
        <a href="#">Hot</a>
        <a href="#">Random</a>
        <a href="#">Saved Searches</a>
        <a href="#">URLs</a>
        <a href="{{ route('tos') }}" class="{{ request()->is('posts/tos') ? 'active' : '' }}">TOS</a>
        <a href="{{ route('dcma') }}" class="{{ request()->is('posts/dcma') ? 'active' : '' }}">DCMA</a>
        <a href="#">Help</a>
    </nav>
</div>
