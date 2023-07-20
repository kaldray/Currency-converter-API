<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiPublicAvailbleDevisesCollection;
use App\Models\Paire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiPublicAvailbleDevises extends Controller
{
    public function available()
    {
        return new ApiPublicAvailbleDevisesCollection(Paire::all(['from', "to"]));
    }

    public function conversion(Request $request, string $from, string $amount, string $to)
    {
        $paire = Paire::where([["from", $from], ["to", $to]])->first();

        if ($paire == null) {
            return Response::json(["message" => "Désole, cette paire de conversion n'existe pas.", "status" => \Illuminate\Http\Response::HTTP_NOT_FOUND]);
        }

        $newAmonut = $this->getNewConvertedAmount($paire->convertion_rate, $amount);
        return Response::json(["from" => $from, "to" => $to, "convertedAmount" => $newAmonut], \Illuminate\Http\Response::HTTP_OK);
    }

    private function getNewConvertedAmount(int $conversionRate, $toBeConverted): int
    {
        return $conversionRate * $toBeConverted;
    }
}

