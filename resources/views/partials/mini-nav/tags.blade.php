<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex secondary-nav">
        <a href="{{ route('tags') }}" class="{{ request()->is('tags') ? 'active' : '' }}">List</a>
        <a href="#">Implications</a>
        <a href="#">Saved Searches</a>
        <a href="{{ route('tagsBulk') }}" class="{{ request()->is('tags/bulk') ? 'active' : '' }}" style="color: #faad13;">Bulk Add</a>
    </nav>
</div>
