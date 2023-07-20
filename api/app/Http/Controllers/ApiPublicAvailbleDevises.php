<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiPublicAvailbleDevisesCollection;
use App\Models\Paire;
use Illuminate\Http\Request;

class ApiPublicAvailbleDevises extends Controller
{
    public function available()
    {
        return new ApiPublicAvailbleDevisesCollection(Paire::all(['from', "to"]));
    }
}

