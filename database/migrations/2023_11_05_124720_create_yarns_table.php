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
        Schema::create('yarns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yarn_id_ravelry');
            $table->string('yarn_name');
            $table->string('yarn_brand');
            $table->string('yarn_color');
            $table->string('yarn_fiber');
            $table->float('yarn_min_price', 8, 2)->nullable();
            $table->float('yarn_max_price', 8, 2)->nullable();
            $table->string('yarn_price_country');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yarns');
    }
};
