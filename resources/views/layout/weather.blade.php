@php

/**
 * @var bool $showWeather
 * @var string $cityName
 * @var int $currentTemp
 * @var int $feelslikeTemp
 * @var int $maxTemp
 * @var int $minTemp
 * @var string $weatherDescription
 * @var bool $iconExist
 * @var string $iconUrl
 */

@endphp

@if($showWeather)
    <h4 class="mb-4 font-italic">Погода сейчас</h4>
    <div class="card shadow-0 border">
        <div class="card-body p-4">
            <h4 class="mb-3">{{ $cityName }}</h4>
            <p class="mb-2">Температура: <strong>{{ $currentTemp }}°C</strong></p>
            <p>Ощущается как: <strong>{{ $feelslikeTemp }}°C</strong></p>
            <p>Макс: <strong>{{ $maxTemp }}°C</strong>, Мин: <strong>{{ $minTemp }}°C</strong></p>
            <div class="d-flex flex-row align-items-center">
                <p class="mb-0 me-4">{{ $weatherDescription }}</p>
                @if($iconExist)
                    <img src="{{ $iconUrl }}" alt="forecast_img"/>
                @endif
            </div>
        </div>
    </div>
@endif
