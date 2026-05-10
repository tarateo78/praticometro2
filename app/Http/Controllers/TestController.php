<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::all();
        return view("test.index", compact("tests"));
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
    public function store(Request $request)
    {
        // 1. Validazione (Fondamentale!)
        $validated = $request->validate([
            'testo' => 'required|string|max:255',
            'numero' => 'integer',
            'valuta' => 'numeric',
            'data' => 'date',
        ]);

        // 2. Salvataggio nel Database
        Test::create($validated);

        // 3. Redirect con messaggio di successo
        return redirect()->back()->with('success', 'Record aggiunto con successo!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        return view("test.edit", compact("test"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        // Prima della validazione trasforma la valuta formattata testo in numero col . decimale
        $request->merge([
            'valuta' => str_replace(',', '.', str_replace(".", "", $request->valuta)),
        ]);

        $validated = $request->validate([
            'testo' => 'required|string|max:255',
            'numero' => 'integer',
            'valuta' => 'numeric',
            'data' => 'date',
        ]);

        $test->update($validated);

        return redirect()->route('test.index', $test)->with('status', 'test aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        //
    }
}
