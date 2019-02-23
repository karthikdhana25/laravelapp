<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $name = "'David' OR 1=1";
        // $res = DB::select(
        // DB::raw("SELECT * FROM users WHERE name = $name"));
        // print_r( $res ); die;

        return view('home');
    }
}
