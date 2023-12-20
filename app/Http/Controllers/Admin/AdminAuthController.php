<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;


class AdminAuthController extends Controller
{
    public function index() : ViewView
    {
        return view('admin.auth.login');
    }

}
