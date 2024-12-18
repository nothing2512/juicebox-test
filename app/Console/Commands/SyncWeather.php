<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Weather Every Hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiKey = env("WEATHER_API_KEY");
        $city = 'Perth';
        $url = "https://api.weatherapi.com/v1/current.json";

        $response = Http::get($url, [
            'q' => $city,
            'key' => $apiKey,
        ]);

        $weather = Weather::query()->first();
        if ($weather == null) $weather = new Weather();
        $weather->fill($response->json()["current"]);
        $weather->save();
    }
}
