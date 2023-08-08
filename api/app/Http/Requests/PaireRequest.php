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
        Rule::unique("paires", "from")
          ->where("from", $this->from)
          ->where("to", $this->to)
          ->ignore($this->get("id")),
      ],
      "to" => [
        "required",
        "exists:devises,name",
        Rule::unique("paires", "to")
          ->where("to", $this->to)
          ->where("from", $this->from)
          ->ignore($this->get("id")),
      ],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      "conversion_number.required" => "Ce champs est requis",
      "conversion_rate.required" => "Ce champs est requis",
      "from.required" => "Ce champs est requis",
      "to.required" => "Ce champs est requis",
      "*.exists" => "Cette valeur n'exsite pas",
      "*.unique" => "Cette paire est déja utilisé",
    ];
  }
}
