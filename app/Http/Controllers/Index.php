<?php

namespace App\Http\Controllers;

class Index extends Controller
{
    public function welcome()
    {
        return view('index/index');
    }
}
