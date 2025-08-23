<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs.list');
    }

    public function browse()
    {
        $jobs = Lowongan::with('kategoriLowongan')->latest()->get();
        return view('jobs.browse', compact('jobs'));
    }
}
