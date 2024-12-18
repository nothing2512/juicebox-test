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
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('last_updated_epoch');
            $table->timestamp('last_updated');
            $table->float('temp_c');
            $table->float('temp_f');
            $table->boolean('is_day');
            $table->float('wind_mph');
            $table->float('wind_kph');
            $table->integer('wind_degree');
            $table->string('wind_dir', 10);
            $table->float('pressure_mb');
            $table->float('pressure_in');
            $table->float('precip_mm');
            $table->float('precip_in');
            $table->integer('humidity');
            $table->integer('cloud');
            $table->float('feelslike_c');
            $table->float('feelslike_f');
            $table->float('windchill_c');
            $table->float('windchill_f');
            $table->float('heatindex_c');
            $table->float('heatindex_f');
            $table->float('dewpoint_c');
            $table->float('dewpoint_f');
            $table->float('vis_km');
            $table->float('vis_miles');
            $table->float('uv');
            $table->float('gust_mph');
            $table->float('gust_kph');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
