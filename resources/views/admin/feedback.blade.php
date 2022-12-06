@php

/**
 * @var string $title
 * @var LengthAwarePaginator $messages
 * @var Message $message
 */

use App\Models\Message;
use Illuminate\Pagination\LengthAwarePaginator;

@endphp

@section('title', 'Обратная связь')

@extends('admin.layouts.master')

@section('content')
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="p-3 mb-5 bg-light rounded">Всего обращений: <b>{{ $messages->count() }}</b></div>
                @forelse($messages as $message)
                    <div class="mb-5">
                        <p><b>#{{ $message->id }}</b> | {{ $message->created_at->translatedFormat('j F Y') }} от <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
                        <p>{{ $message->body }}</p>
                        <hr>
                    </div>
                @empty
                    <p>Обращений пока нет.</p>
                @endforelse
                {{ $messages->onEachSide(config('pagination.admin_section.each_side'))->links() }}
            </div>
        </div>
    </div>
@endsection
