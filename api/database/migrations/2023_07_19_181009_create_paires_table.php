<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paires', function (Blueprint $table) {
            $table->id();
            $table->string("from");
            $table->string("to");
            $table->unique(['from', "to"]);
            $table->float("convertion_rate", 8, 2, true);
            $table->unsignedInteger("convertion_number");
            $table->timestamps();

            $table->foreign("from")->references("name")->on("devises");
            $table->foreign("to")->references("name")->on("devises");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paires');
    }
};
