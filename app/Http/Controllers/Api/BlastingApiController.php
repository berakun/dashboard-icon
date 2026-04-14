<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blasting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BlastingApiController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input API
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required|exists:users,id', // Kita butuh ID user untuk ambil data Agent/Dept
            'phone'         => 'required|string',
            'template_name' => 'required|string',
            'language'      => 'required|in:id,en',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2. Ambil data user berdasarkan ID yang dikirim
        $user = User::find($request->user_id);

        // 3. Simpan ke Database
        $blasting = Blasting::create([
            'name'           => $user->name,
            'agent_id'       => $user->agent,
            'department_id'  => $user->department,
            'phone'          => $request->phone,
            'template_name'  => $request->template_name,
            'language'       => $request->language,
            'broadcast_id'   => Str::random(10), // Tetap otomatis acak
            'broadcast_time' => now(),
            'status_response' => 'pending',
        ]);

        // 4. Response JSON
        return response()->json([
            'success' => true,
            'message' => 'Blasting data created successfully',
            'data'    => $blasting
        ], 201);
    }
}
