<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

/**
 * Class MessageController
 * @package App\Http\Controllers
 */
class MessageController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        return view('contacts');
    }

    /**
     * @param StoreMessageRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMessageRequest $request): RedirectResponse
    {
        /** @var Message $message */
        $message = Message::create($request->validated());

        return redirect()->back()->with('success', 'Ваше обращение успешно зарегистрировано под номером #' . $message->id);
    }
}
