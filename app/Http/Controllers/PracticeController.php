<?php
namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PracticeController extends Controller
{

    public function index(Request $request): View
    {
        // $practices = Practice::where("is_in_corso", true)->orderBy("codice", "desc")->get();
        // $practices = Practice::when($request->cerca, function ($query) use ($request) {
        //     return $query->whereAny(['codice', 'titlo', 'titolo_esteso'], 'like', "%" . $request->cerca . "%");
        // })->get();
        $practices = Practice::when($request->cerca, function ($query) use ($request) {
            return $query->whereAny(['codice', 'titlo', 'titolo_esteso'], 'like', "%" . $request->cerca . "%")->where('is_in_corso', isset($request->is_in_corso) ? true : false);
        })->orderBy("codice", "desc")->get();


        //$practices = Practice::where("codice", "LIKE", "V26%")->get();
        //$practices = Practice::all();
        // dd($practice);
        return view("practices.index", compact("practices"));
    }

    public function form(Practice $practice)
    {
        // Se l'ID non esiste, Laravel restituirà automaticamente un errore 404
        return view('practices.form', compact('practice'));
    }

    public function create()
    {
        // Passiamo un'istanza vuota del modello
        $practice = new Practice();
        return view('practices.form', compact('practice'));
    }

    public function edit(Practice $practice)
    {
        // Se l'ID non esiste, Laravel restituirà automaticamente un errore 404
        return view('practices.edit', compact('practice'));
    }

    public function update(Request $request, Practice $practice)
    {
        // 1. Valida i dati

        $validated = $request->validate([
            'codice' => 'required|max:255',
            'titolo' => 'nullable',
            'titolo_esteso' => 'nullable',
            'zona' => 'nullable',
            'cup' => 'nullable',
            'finanziamento' => 'nullable',
            'finanziamento_note' => 'nullable',
            'rup' => 'nullable',
            'fascicolo' => 'nullable',
            'importo' => 'nullable',
            'is_rl' => 'nullable',
            'is_mims' => 'nullable',
            'rl_codice' => 'nullable',
            'mims_codice' => 'nullable',
            'avvio_servizio_at' => 'nullable',
            'is_avvio_progettazione' => 'nullable',
            'progettista' => 'nullable',
            'sicurezza' => 'nullable',
            'file_count' => 'nullable',
            'file_effettivi_count' => 'nullable',
            'fte_at' => 'nullable',
            'def_at' => 'nullable',
            'ese_at' => 'nullable',
            'cds_at' => 'nullable',
            'cds_chiusa_at' => 'nullable',
            'is_avvio_gara' => 'nullable',
            'contratto_at' => 'nullable',
            'is_lavori_in_corso' => 'nullable',
            'direttore_lavori' => 'nullable',
            'assistente_dl' => 'nullable',
            'consegna_lavori_at' => 'nullable',
            'impresa' => 'nullable',
            'lavori_note' => 'nullable',
            'is_cre' => 'nullable',
            'cre_at' => 'nullable',
            'appunti_progettazione' => 'nullable',
            'rup_note' => 'nullable',
            'capitolo' => 'nullable',
            'urgente' => 'nullable',
            'urgente_nota' => 'nullable',
            'prossima_scadenza_nota' => 'nullable',
            'prossima_scadenza_at' => 'nullable',
            'bdap' => 'nullable',
            'bdap_convalidato' => 'nullable',
            'bdap_note' => 'nullable',
            'sito_internet' => 'nullable',
            'sito_internet_nota' => 'nullable',
            'rif_llpp' => 'nullable',
            'determina_gruppo' => 'nullable',
            'check_at' => 'nullable',
            'modifica_at' => 'nullable',
            'modifica_utente' => 'nullable',
            'alias' => 'nullable',
            'scadenza_progetto' => 'nullable',
            'scadenza_affidamento' => 'nullable',
            'scadenza_esecutivo' => 'nullable',
            'gruppo' => 'nullable',
            'coordinate' => 'nullable',
        ]);

        // 2. Aggiorna il modello
        $practice->update($validated);
        // $practice->update();

        // 3. Ritorna alla lista o al dettaglio con un messaggio di successo
        return redirect()->route('practices.edit', $practice)->with('status', 'practice aggiornato con successo!');
    }
}
