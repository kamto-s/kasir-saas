<?php

namespace App\Http\Controllers;

abstract class BaseController extends Controller
{
    protected function success(string $message)
    {
        return redirect()->back()->with('success', $message);
    }

    protected function error(string $message)
    {
        return redirect()->back()->with('error', $message);
    }
}
