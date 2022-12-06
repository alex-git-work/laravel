@php

/**
* @var Collection $comments
* @var Comment $comment
*/

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

@endphp

<h3 class="blog-post-title mb-4 mt-5" id="comments">Комментарии</h3>
@foreach($comments as $comment)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title float-left">{{ $comment->user->name }}</h5>
            <span class="text-muted float-right">{{ $comment->created_at->translatedFormat('j F Y') }}</span>
            <div class="clearfix"></div>
            <hr>
            <p>{{ $comment->body }}</p>
        </div>
    </div>
@endforeach
