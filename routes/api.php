<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function() {
    Route::post("/login", [AuthController::class, "login"]);
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/logout", [AuthController::class, "logout"])->middleware("auth:sanctum");
});

Route::middleware("auth:sanctum")->prefix("user")->group(function() {
    Route::get("/me", [UserController::class, "getLoggedUser"]);
    Route::get("/{id}", [UserController::class, "show"]);
    Route::get("", [UserController::class, "index"]);
    Route::get("/{id}/posts", [UserController::class, "posts"]);
});

Route::apiResource("post", PostController::class)->middleware("auth:sanctum");

Route::get("/weather", [WeatherController::class, "show"]);