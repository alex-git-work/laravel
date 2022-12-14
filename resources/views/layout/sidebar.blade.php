@php

/**
 * @var Collection $cloud
 * @var Tag $tag
 */

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

@endphp
        <aside class="col-md-4 blog-sidebar">
            <div class="p-3 mb-3 bg-light rounded">
                <h4 class="font-italic">About</h4>
                <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            </div>

            <div class="p-3">
                <h4 class="font-italic">Метки</h4>
                @if($cloud->isNotEmpty())
                    @foreach($cloud as $tag)
                        <a class="badge badge-secondary text-white" href="{{ route('tag.index', ['tag' => $tag]) }}">{{ $tag->name }}</a>
                    @endforeach
                @endif
            </div>

            <div class="p-3">
                @if(request()->routeIs('index'))
                    @include('layout.weather')
                @else
                    <h4 class="font-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ol>
                @endif
            </div>
        </aside><!-- /.blog-sidebar -->
