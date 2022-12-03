@php

/**
 * @var Collection $tags
 * @var Tag $tag
 */

use Illuminate\Database\Eloquent\Collection;
use App\Models\Tag;

@endphp

@if($tags->isNotEmpty())
    <hr>
    <div>
        <span class="text-muted">Метки:</span>
        @foreach($tags as $tag)
            <a class="badge badge-secondary text-white" href="{{ route('tag.index', ['tag' => $tag]) }}">{{ $tag->name }}</a>
        @endforeach
    </div>
    <br>
@endif
