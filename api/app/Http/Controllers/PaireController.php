<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaireRequest;
use App\Models\Paire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;

class PaireController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Paire $paire)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(PaireRequest $request, Paire $paire)
  {
    try {
      $validateData = $request->validated();
      $paire->update($validateData);
      return Response::json([
        "message" => "La paire a bien été modifié.",
        "status" => \Illuminate\Http\Response::HTTP_OK,
      ]);
    } catch (\Exception $exception) {
      return $exception;
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(int $id)
  {
    try {
      $res = Paire::destroy($id);
      return Response::json(
        [
          "message" => "L'opération à été un succès",
          "status" => \Illuminate\Http\Response::HTTP_OK,
        ],
        \Illuminate\Http\Response::HTTP_OK
      );
    } catch (\Exception $err) {
      return $err;
    }
  }
}
