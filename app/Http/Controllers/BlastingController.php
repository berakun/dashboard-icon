<?php

namespace App\Http\Controllers;

use App\Models\Blasting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BlastingController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            // Pastikan baris ini ada agar datanya terkirim ke Vue
            'blastings' => \App\Models\Blasting::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'template_name' => 'required',
            'language' => 'required|in:id,en',
        ]);

        $user = Auth::user();

        Blasting::create([
            'name'          => $user->name,
            'agent_id'      => $user->agent,
            'department_id' => $user->department,

            'phone'          => $request->phone,
            // Generate otomatis 10 karakter acak (Campuran huruf & angka)
            'broadcast_id'   => Str::random(10),
            'language'       => $request->language,
            'template_name'  => $request->template_name,
            'broadcast_time' => now(),
            'status_response' => 'pending',
        ]);

        // Berikan flash message agar bisa dibaca di Vue
        return redirect()->back()->with('success', 'Data blasting berhasil dibuat!');
    }
}
