<?php
namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{

    public function index(): View
    {
        // Recupera il GET dall'indirizzo link
        if (isset($_GET['annoBase'])) $annoBase = $_GET['annoBase'];
        else $annoBase = date("Y"); // Anno corrente

        // Esegue la query di ricerca
        $practices = Practice::where('is_in_corso', true)
            ->where('is_avvio_progettazione', true)
            ->orderBy("codice", "desc")
            ->get();

        // Predispongo i dati per la sezione Progettazione
        $progettazione = [];
        foreach ($practices as $prac){
            if ( substr($prac->ese_at, 0, 4) == $annoBase 
                    || $prac->is_avvio_progettazione && empty($prac->ese_at) )
            {
                    $progettazione[$prac->codice]= $prac;
            }
        }


        // Predispongo i dati per la sezione Conferenza
        $cds = [];
        foreach ($practices as $prac) {
            if( substr($prac->cds_chiusa_at, 0, 4) == $annoBase 
                || ( (empty($prac->cds_chiusa_at) || substr($prac->cds_chiusa_at, 0, 4) > $annoBase ) 
                    && !empty($prac->cds_avvio_at) && substr($prac->cds_avvio_at,0,4) <= $annoBase)
                ) {
                $cds[$prac->codice] = $prac;
            }
        }
        
        // Predispongo i dati per la sezione Gara
        $gara = [];
        foreach ($practices as $prac) {
            if (substr($prac->contratto_at, 0, 4) == $annoBase ||
                $prac->is_avvio_gara && substr($prac->ese_at, 0, 4) <= $annoBase && empty($prac->contratto) && !$prac->is_lavori_in_corso
            ) {
                $gara[$prac->codice] = $prac;
            }
        }
        
        // Predispongo i dati per la sezione Esecuzione
        $lavori = [];
        foreach ($practices as $prac) {
            if (($prac->is_lavori_in_corso && substr($prac->consegna_lavori_at, 0, 4) == $annoBase)) {
                $lavori[$prac->codice] = $prac;
            }
        }

        return view("report.index", compact("practices", "annoBase", "progettazione", "cds", "gara", "lavori" ));
    }

    public function show(Practice $practice)
    {
        // Se l'ID non esiste, Laravel restituirà automaticamente un errore 404
        return view('openweb.show', compact('practice'));
    }

}
