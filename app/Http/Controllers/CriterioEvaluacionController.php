<?php

namespace App\Http\Controllers;

use App\CriterioEvaluacion;
use Illuminate\Http\Request;

class CriterioEvaluacionController extends Controller
{
  public function index(Request $request)
  {
      return view('page_admin.criterios');
  }

  public function store(Request $request)
  {
      //
  }

  public function show(Request $request)
  {
      //
  }

  public function edit(Request $request)
  {
      //
  }

  public function destroy(Request $request)
  {
      //
  }
}
