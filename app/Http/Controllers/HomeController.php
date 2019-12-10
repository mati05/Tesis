<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $type = Auth::user()->rol;
        switch ($type) {
          case '1':
            return redirect()->route('home_admin');
            break;
          case '2':
            return redirect()->route('home_docente');
          case '3':
              return redirect()->route('home_alumno');
          default:
            Session::flash('message', "ERROR!, El tipo de usuario ingresado no está registrado");
            return Redirect::back();
            break;
        }
    }
}
