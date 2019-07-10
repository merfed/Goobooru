<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex secondary-nav">
        <a href="#">List</a>
        <a href="{{ route('upload') }}" class="{{ request()->is('posts/upload') ? 'active' : '' }}">Upload</a>
        <a href="#">Hot</a>
        <a href="#">Random</a>
        <a href="#">Saved Searches</a>
        <a href="#">URLs</a>
        <a href="#">TOS</a>
        <a href="#">DCMA</a>
        <a href="#">Help</a>
    </nav>
</div>
