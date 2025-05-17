<?php

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('tweet', function () {
        request()->validate([
            'content' => 'required|max:140|string',
        ]);

        $tweet = request()->user()->tweets()->create([
            'content' => request('content'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tweet created successfully',
            'data' => $tweet
        ], 201);
    });

    Route::get('tweets', function () {
        return response()->json([
            'status' => 'success',
            'message' => 'Tweets retrieved successfully',
            'data' => Tweet::with('user')->get()
        ], 200);
    });
});