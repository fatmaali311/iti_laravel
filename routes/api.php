<?php

 use App\Http\Controllers\Api\PostController;
 use App\Models\User;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Facades\Route;
 use Illuminate\Validation\ValidationException;

 Route::get('/user', function (Request $request) {
     return $request->user();
 })->middleware('auth:sanctum');

//  Route::get('posts', [PostController::class, 'index']);
 Route::middleware('auth:sanctum')->get('posts', [PostController::class, 'index']);

 Route::get('posts/{post}', [PostController::class, 'show']);
 Route::middleware('auth:sanctum')->post('posts', [PostController::class, 'store']);

 Route::post('/sanctum/token', function (Request $request) {
     $request->validate([
         'email' => 'required|email',
         'password' => 'required',
         'device_name' => 'required',
     ]);

     $user = User::where('email', $request->email)->first();

     if (! $user || ! Hash::check($request->password, $user->password)) {
         throw ValidationException::withMessages([
             'email' => ['The provided credentials are incorrect.'],
         ]);
     }

     return $user->createToken($request->device_name)->plainTextToken;
 });
