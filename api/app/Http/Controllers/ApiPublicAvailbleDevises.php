<?php

namespace App\Http\Controllers;


use App\Models\Paire;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ApiPublicAvailbleDevises extends Controller
{


  public function conversion(Request $request, string $from, string $amount, string $to)
  {
    try {
      $paire = Paire::where([["from", $from], ["to", $to]])->firstOrFail();
      $newAmonut = $this->getNewConvertedAmount($paire->conversion_rate, $amount);
      $paire->conversion_number = $paire->conversion_number + 1;
      $paire->save();
      return Response::json(
        ["from" => strtoupper($from), "to" => strtoupper($to), "convertedAmount" => $newAmonut],
        ResponseAlias::HTTP_OK
      );
    } catch (ModelNotFoundException $exception) {
      return Response::json(
        [
          "message" => "Désole, cette paire de conversion n'existe pas.",
          "status" => \Illuminate\Http\Response::HTTP_NOT_FOUND,
        ],
        ResponseAlias::HTTP_NOT_FOUND
      );
    }
  }

  private function getNewConvertedAmount(string $conversionRate, string $toBeConverted): int
  {
    return $conversionRate * $toBeConverted;
  }
}
