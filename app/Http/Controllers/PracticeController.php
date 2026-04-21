<?php
namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PracticeController extends Controller
{

    public function index(Request $request): View
    {

        $practices = Practice::when($request->filtra, function ($query) use ($request) {

            $termini = explode("+", $request->filtra);

            foreach ($termini as $termine) {
                $query->whereAny(['codice', 'titolo', 'stato_pratica', 'zona', 'strade', 'importo', 'finanziamento'], 'like', "%" . $termine . "%");
            }
            return $query;
        })
            ->when($request->is_in_corso, function ($query) use ($request) {
                return $query->where('is_in_corso', isset($request->is_in_corso) ? true : false);
            })

            ->orderBy("codice", "desc")
            ->get();

        // $practices = Practice::all();
        // dd($practice);
        return view("practices.index", compact("practices"));





        // VECCHIO PROCEDIMENTO
        // $practices = Practice::when($request->filtra, function ($query) use ($request) {
        //     return $query->whereAny(['codice', 'titlo', 'titolo_esteso'], 'like', "%" . $request->filtra . "%");
        // })->when($request->is_in_corso, function ($query) use ($request) {
        //     return $query->where('is_in_corso', isset($request->is_in_corso) ? true : false);
        // })->orderBy("codice", "desc")->get();
        // return view("practices.index", compact("practices"));
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
            'codice' => 'required|max:5',
            'is_in_corso' => 'nullable',
            'titolo' => 'nullable',
            'titolo_esteso' => 'nullable',
            'zona' => 'nullable',
            'strade' => 'nullable',
            'cup' => 'nullable',
            'finanziamento' => 'nullable',
            'finanziamento_note' => 'nullable',
            'rup' => 'nullable',
            'fascicolo' => 'nullable',
            'importo' => 'nullable',
            'is_rl' => '',
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
            'is_cds' => 'nullable',
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
            'pratica_note' => 'nullable',
            'bdap' => 'nullable',
            'bdap_convalidato' => 'nullable',
            'bdap_note' => 'nullable',
            'sito_internet' => 'nullable',
            'sito_internet_nota' => 'nullable',
            'determina_gruppo' => 'nullable',
            'check_at' => 'nullable',
            'modifica_at' => 'nullable',
            'modifica_utente' => 'nullable',
            'scadenza_progetto' => 'nullable',
            'scadenza_affidamento' => 'nullable',
            'scadenza_esecuzione' => 'nullable',
            'gruppo' => 'nullable',
            'coordinate' => 'nullable',
            'file_nuovi' => 'nullable',
        ]);

        // Impone che anche i check non flaggati vengano registrati
        $validated['is_in_corso'] = $request->has('is_in_corso');
        $validated['is_rl'] = $request->has('is_rl');
        $validated['is_mims'] = $request->has('is_mims');
        $validated['is_avvio_progettazione'] = $request->has('is_avvio_progettazione');
        $validated['is_lavori_in_corso'] = $request->has('is_lavori_in_corso');
        $validated['is_avvio_gara'] = $request->has('is_avvio_gara');
        $validated['is_cre'] = $request->has('is_cre');
        $validated['is_cds'] = $request->has('is_cds');
        $validated['bdap'] = $request->has('bdap');
        $validated['bdap_convalidato'] = $request->has('bdap_convalidato');
        $validated['sito_internet'] = $request->has('sito_internet');



        // 2. Aggiorna il modello
        $practice->update($validated);
        // $practice->update();

        // 3. Ritorna alla lista o al dettaglio con un messaggio di successo
        return redirect()->route('practices.edit', $practice)->with('status', 'practice aggiornato con successo!');
    }
}
