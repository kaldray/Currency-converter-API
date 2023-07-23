<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiPublicAvailableDevisesResource;
use App\Models\Paire;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiPublicAvailbleDevises extends Controller
{
  public function available()
  {
    return ApiPublicAvailableDevisesResource::collection(
      Paire::all(["from", "to", "conversion_number", "id", "conversion_rate"])
    );
  }

  public function conversion(Request $request, string $from, string $amount, string $to)
  {
    try {
      $paire = Paire::where([["from", $from], ["to", $to]])->firstOrFail();
      $newAmonut = $this->getNewConvertedAmount($paire->conversion_rate, $amount);
      $paire->conversion_number = $paire->conversion_number + 1;
      $paire->save();
      return Response::json(
        ["from" => strtoupper($from), "to" => strtoupper($to), "convertedAmount" => $newAmonut],
        \Illuminate\Http\Response::HTTP_OK
      );
    } catch (ModelNotFoundException $exception) {
      return Response::json(
        [
          "message" => "Désole, cette paire de conversion n'existe pas.",
          "status" => \Illuminate\Http\Response::HTTP_NOT_FOUND,
        ],
        \Illuminate\Http\Response::HTTP_NOT_FOUND
      );
    }
  }

  private function getNewConvertedAmount(string $conversionRate, string $toBeConverted): int
  {
    return $conversionRate * $toBeConverted;
  }
}
