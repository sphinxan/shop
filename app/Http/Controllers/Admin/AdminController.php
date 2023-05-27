<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('admin.index');
    }

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }
}
