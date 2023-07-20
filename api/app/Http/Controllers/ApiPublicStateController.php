<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiPublicStateController extends Controller
{
    public function state()
    {
        return response(["data" => "Le service est fonctionnel"], 200);
    }
}
