@php

/**
 * @var string $title
 * @var Collection $messages
 * @var Message $message
 */

use Illuminate\Database\Eloquent\Collection;
use App\Models\Message;

@endphp

@section('title', $title = 'Админ. раздел')

@extends('layout.master')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $title }}</h3>
    <div class="p-3 mb-5 bg-light rounded">Всего обращений: <b>{{ $messages->count() }}</b></div>
    @if($messages->isNotEmpty())
        @foreach($messages as $message)
            <div class="blog-post">
                <p class="blog-post-meta"><b class="text-dark">#{{ $message->id }}</b> | {{ $message->created_at->translatedFormat('j F Y') }} от <a href="#">{{ $message->email }}</a></p>
                <p>{{ $message->body }}</p>
                <hr>
            </div>
        @endforeach
    @else
        <p>Обращений пока нет.</p>
    @endif
@endsection
