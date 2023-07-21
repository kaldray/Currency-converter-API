<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paire extends Model
{
  use HasFactory;

  protected $fillable = ["conversion_number", "conversion_rate", "from", "to"];

  public function deviseFrom(): BelongsTo
  {
    return $this->belongsTo(Devise::class, "from", "name");
  }

  public function deviseTo(): BelongsTo
  {
    return $this->belongsTo(Devise::class, "to", "name");
  }
}
