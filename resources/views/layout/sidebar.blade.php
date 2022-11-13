@php

/**
 * @var Collection $cloud
 * @var Tag $tag
 * @var OpenWeatherMap $forecast
 */

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use App\Services\OpenWeatherMap;

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
                @if(request()->routeIs('index') && $forecast->responseSuccess())
                    <h4 class="mb-4 font-italic">Погода сейчас</h4>
                    <div class="card shadow-0 border">
                        <div class="card-body p-4">

                            <h4 class="mb-3">{{ $forecast->getCityName() }}</h4>
                            <p class="mb-2">Температура: <strong>{{ $forecast->getCurrentTemp() }}°C</strong></p>
                            <p>Ощущается как: <strong>{{ $forecast->getFeelslikeTemp() }}°C</strong></p>
                            <p>Макс: <strong>{{ $forecast->getMaxTemp() }}°C</strong>, Мин: <strong>{{ $forecast->getMinTemp() }}°C</strong></p>

                            <div class="d-flex flex-row align-items-center">
                                <p class="mb-0 me-4">{{ $forecast->getWeatherDescription() }}</p>
                                @if($forecast->iconExist())
                                    <img src="{{ $forecast->getIconUrl() }}" alt="forecast_img"/>
                                @endif
                            </div>

                        </div>
                    </div>
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
