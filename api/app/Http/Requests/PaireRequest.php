<?php

namespace App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PaireRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return Auth::check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [
      "conversion_number" => ["required", "numeric"],
      "conversion_rate" => ["required", "numeric"],
      "from" => [
        "required",
        "exists:devises,name",
        Rule::unique("paires", "from")->ignore($this->from, "from"),
      ],
      "to" => [
        "required",
        "exists:devises,name",
        Rule::unique("paires", "to")->ignore($this->to, "to"),
      ],
    ];
  }
}
