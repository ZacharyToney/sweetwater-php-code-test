<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskOne extends Controller
{
    public function index()
    {
        $sweetwater_test = DB::table('sweetwater_test')->get();
        dd($sweetwater_test);
        return view('task1');
    }
}
