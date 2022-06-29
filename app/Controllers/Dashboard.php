<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Makassar");
        session();
    }

    public function index()
    {
        return view('dashboard/index');
    }

    public function test()
    {
        dd('a');
    }
}
