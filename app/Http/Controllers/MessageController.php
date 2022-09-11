<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'email' => ['required', 'max:64'],
                'body' => ['required'],
            ],
            [
                'email.required' => 'Поле Email обязательно для заполнения',
                'email.max' => 'Длина Email не должна превышать 64 символа',
                'body.required' => 'Поле Сообщение обязательно для заполнения'
            ]
        );

        /** @var Message $message */
        $message = Message::create($validated);

        return redirect()->back()->with('success', 'Ваше обращение успешно зарегистрировано под номером #' . $message->id);
    }
}
