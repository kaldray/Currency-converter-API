<?php

namespace App\Http\Controllers;

use App\Http\Resources\DevisesRessource;
use App\Models\Devise;

class DevisesController extends Controller
{
  public function index()
  {
    return DevisesRessource::collection(Devise::all());
  }
}
