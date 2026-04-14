<?php

use App\Http\Controllers\Api\BlastingApiController;
use Illuminate\Support\Facades\Route;

// Endpoint: POST /api/blasting
Route::post('/blasting', [BlastingApiController::class, 'store']);
