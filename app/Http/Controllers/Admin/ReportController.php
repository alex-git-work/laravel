<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
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
     */
    public function store(Request $request)
    {
        $request->dump();
    }
}
