<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaireRequest;
use App\Http\Resources\ApiPublicAvailableDevisesResource;
use App\Models\Paire;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class PaireController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
      return ApiPublicAvailableDevisesResource::collection(
          Paire::all()
      );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PaireRequest $request)
  {
    try {
      Paire::create($request->validated());
      return Response::json([
        "message" => "L'opération s'est déroulée avec succès",
        "status" => \Illuminate\Http\Response::HTTP_OK,
      ]);
    } catch (ValidationException $exception) {
      return Response::json([
        "message" => $exception,
        "status" => \Illuminate\Http\Response::HTTP_OK,
      ]);
    }
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
    } catch (ValidationException $exception) {
      return $exception;
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      Paire::destroy($id);
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
