<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\TotalReport;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class ReportController
 * @package App\Http\Controllers\Admin
 */
class ReportController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.report.index');
    }

    /**
     * @return View
     */
    public function total(): View
    {
        return view('admin.report.total');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            ['report' => ['required']],
            ['report.required' => 'Выберите параметры для отчета']
        );

        TotalReport::dispatch($validated['report'], auth()->user());

        return redirect()->back()->with('success', 'Отчет формируется, и скоро будет отправлен вам');
    }
}
