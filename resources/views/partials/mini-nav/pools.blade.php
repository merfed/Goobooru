<div class="secondary-header d-flex flex-items-center">
    <nav class="d-flex secondary-nav">
        <a href="{{ route('pools') }}" class="{{ request()->is('pools') ? 'active' : '' }}">List</a>
        <a href="{{ route('poolsCreate') }}" class="{{ request()->is('pools/new') ? 'active' : '' }}">New</a>
        <a href="{{ route('poolsBulkAddPost') }}" class="{{ request()->is('pools/add/posts') ? 'active' : '' }}" style="color: #faad13;">Bulk Add Posts</a>
        <a href="{{ route('poolsBulkAddTags') }}" class="{{ request()->is('pools/add/tags') ? 'active' : '' }}" style="color: #faad13;">Bulk Add Tags</a>
        <a href="#">Help</a>
    </nav>
</div>
