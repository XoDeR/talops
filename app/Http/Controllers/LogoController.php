<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Http\Requests\StoreLogoRequest;
use App\Http\Requests\UpdateLogoRequest;
use Illuminate\Support\Str;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLogoRequest $request)
    {
        // $validated = $request->validate([
        //     'image' => ['required', 'image', 'max:2048'],
        // ]);

        $originalName = $request->input('original_name');

        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $uuid = Str::uuid();
        $generatedName = "{$uuid}.{$extension}";

        $file = $request->file('image');
        $file->storeAs('logos', $generatedName, 'public');

        $logo = Logo::create([
            'name' => $generatedName,
            'original_name' => $originalName,
        ]);

        return response()->json(['uuid' => $logo->uuid]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Logo $logo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logo $logo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogoRequest $request, Logo $logo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logo $logo)
    {
        //
    }
}
