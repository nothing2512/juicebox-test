<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command("sync:weather", function() {
    $this->comment("Weather Syncronized");
})->purpose("Syncronize Weather")->hourly();