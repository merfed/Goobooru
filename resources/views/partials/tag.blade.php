<a href="#" style="margin-right: 4px;">?</a>
<a href="{{ route('tagPosts', ['tag' => $tag->name]) }}" class="tag-{{ $tag->getType() }}">{{ $tag->name }}</a>
<span style="color: #ccc;">{{ number_format($tag->posts_count) }}</span>
