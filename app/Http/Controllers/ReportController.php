<?php
namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{

    public function index(): View
    {

        $practices = Practice::where('is_in_corso', true)
            ->where('is_avvio_progettazione', true)
            ->orderBy("codice", "desc")
            ->get();

        return view("report.index", compact("practices"));
    }

    public function show(Practice $practice)
    {
        // Se l'ID non esiste, Laravel restituirà automaticamente un errore 404
        return view('openweb.show', compact('practice'));
    }

}
