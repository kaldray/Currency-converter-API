<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiPublicAvailableDevisesResource;
use App\Models\Paire;
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
      $paire = Paire::where([["from", $from], ["to", $to]])->first();
      if ($paire == null) {
        return Response::json([
          "message" => "Désole, cette paire de conversion n'existe pas.",
          "status" => \Illuminate\Http\Response::HTTP_NOT_FOUND,
        ]);
      }
      $newAmonut = $this->getNewConvertedAmount($paire->conversion_rate, $amount);
      return Response::json(
        ["from" => $from, "to" => $to, "convertedAmount" => $newAmonut],
        \Illuminate\Http\Response::HTTP_OK
      );
    } catch (\Exception $exception) {
      return $exception;
    }
  }

  private function getNewConvertedAmount(string $conversionRate, string $toBeConverted): int
  {
    return $conversionRate * $toBeConverted;
  }
}
