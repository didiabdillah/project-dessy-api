<?php

use App\Mail\FruitEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Http\Resources\UserResource;

use App\Models\Fruit;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    $user = $request->user();

    return response()->json([
        "id" => $user->id,
        "name" => $user->name,
        "email" => $user->email,
        "email_verified_at" => $user->email_verified_at,
        "created_at" => $user->created_at,
        "updated_at" => $user->updated_at,
        "permissions" => $user->getPermissionsViaRoles()->pluck('name')->toArray()
    ]);
});

Route::get("/fruits", function (Request $request) {
   return $request->user()->fruits;
})->middleware("auth:sanctum");

Route::post("/send-fruit-email", function (Request $request) {
    $fruits = $request->user()->fruits;
    
    // Mail::to($request->user()->email)->queue(new FruitEmail($fruits));

    return response()->json(["message" => "Fruit email queued."]);
});