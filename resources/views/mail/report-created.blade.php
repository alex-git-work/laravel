@php

/**
 * @var array $report
 */

use App\Mail\ReportCreated;

@endphp

<x-mail::message>
    # Итого:

    @foreach($report as $key => $value)
        {{ ReportCreated::REPORTABLE[$key] . ': ' . $value }}
    @endforeach


    Рассылка от
    {{ config('app.name') }}
</x-mail::message>
