<?php

use App\Mail\FruitEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Models\Fruit;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/fruits", function (Request $request) {
   return $request->user()->fruits;
})->middleware("auth:sanctum");

Route::post("/send-fruit-email", function (Request $request) {
    $fruits = $request->user()->fruits;
    
    // Mail::to($request->user()->email)->queue(new FruitEmail($fruits));

    return response()->json(["message" => "Fruit email queued."]);
});