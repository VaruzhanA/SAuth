<?php

namespace App\Http\Controllers\Frontend;

use \App\Http\Controllers\Controller;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.home.index');
    }
}
