<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\View\View;



class PracticeController extends Controller
{
    public function index(): View
    {
        $practices = Practice::where("is_in_corso", true)->orderBy("codice", "desc")->take(20)->get();
        //$practices = Practice::where("codice", "LIKE", "V26%")->get();
        //$practices = Practice::all();
        // dd($practice);
        return view("practices.index", compact("practices"));
    }

    public function show(Practice $practice)
    {
        // Se l'ID non esiste, Laravel restituirà automaticamente un errore 404
        return view('practices.show', compact('practice'));
    }
}
