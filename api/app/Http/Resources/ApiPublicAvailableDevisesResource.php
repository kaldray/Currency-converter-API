<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiPublicAvailableDevisesResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      "id" => $this->when($request->user(), $this->id),
      "from" => $this->from,
      "to" => $this->to,
      "conversion_number" => $this->when($request->user(), $this->conversion_number),
      "conversion_rate" => $this->conversion_rate,
    ];
  }
}
