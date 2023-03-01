<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PostC;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/posts', PostC::class);
