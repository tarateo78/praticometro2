<?php
namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class PracticeController extends Controller
{

    public function index(Request $request): View
    {

        // Query base
        $query = Practice::query();

        // Filtra: in corso
        $query->when($request->is_in_corso, function ($q) {
            return $q->where('is_in_corso', true);
        });

        // Filtra: Termini di ricerca
        $termini = preg_split("/[\s,+]+/", $request->filtra);
        if ($termini) {
            foreach ($termini as $termine) {

                // Ottiene la lista di tutte le colonne della tabella 'prodotti'
                $colonne = Schema::getColumnListing('practices');
                $query->where(function ($q) use ($colonne, $termine) {
                    foreach ($colonne as $colonna) {
                        $q->orWhere($colonna, 'LIKE', "%{$termine}%");
                    }
                });
            }
        }

        // Esegue la query (usare get() o paginate())
        $practices = $query->orderBy("codice", "desc")->get();

        // Passa i dati filtrati alla vista
        return view('practices.index', compact('practices'));


        /*

                $practices = Practice::when($request->filtra, function ($query) use ($request) {

                    $termini = preg_split("/[\s,+]+/", $request->filtra);

                    foreach ($termini as $termine) {
                        $query->whereAny(['codice', 'titolo', 'titolo_esteso', 'stato_pratica', 'zona', 'strade', 'importo', 'finanziamento'], 'like', "%" . $termine . "%");
                    }
                    return $query;
                })
                    ->when($request->is_in_corso, function ($query) use ($request) {
                        return $query->where('is_in_corso', isset($request->is_in_corso) ? true : false);
                    })

                    ->when($request->status === 'dainiziare', function ($query) {
                        return $query->where('is_avvio_progettazione', '!=', 1);
                    })

                    ->orderBy("codice", "desc")
                    ->get();

                // $practices = Practice::all();
                // dd($practice);
                return view("practices.index", compact("practices"));
                */

    }



    public function totale(): View
    {
        $practices = Practice::orderBy("codice", "desc")
            ->get();

        return view("practices.elenco-totale", compact("practices"));

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
        // Trasforma l'importo formattato come testo in un numero con il . decimale
        $request->merge([
            'importo' => str_replace(',', '.', str_replace(".", "", $request->importo)),
        ]);

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
            'importo' => 'nullable|numeric',
            'is_rl' => '',
            'is_mims' => 'nullable',
            'rl_codice' => 'nullable',
            'mims_codice' => 'nullable',
            'is_avvio_progettazione' => 'nullable',
            'progettista' => 'nullable',
            'sicurezza' => 'nullable',
            'file_count' => 'nullable',
            'file_effettivi_count' => 'nullable',
            'is_cds' => 'nullable',
            'is_avvio_gara' => 'nullable',
            'is_lavori_in_corso' => 'nullable',
            'direttore_lavori' => 'nullable',
            'assistente_dl' => 'nullable',
            'impresa' => 'nullable',
            'lavori_note' => 'nullable',
            'is_cre' => 'nullable',
            'appunti_progettazione' => 'nullable',
            'pratica_note' => 'nullable',
            'is_bdap' => 'nullable',
            'is_bdap_convalidato' => 'nullable',
            'bdap_note' => 'nullable',
            'is_sito_internet' => 'nullable',
            'sito_internet_nota' => 'nullable',
            'determina_gruppo' => 'nullable',
            'modifica_utente' => 'nullable',
            'gruppo' => 'nullable',
            'coordinate' => 'nullable',
            'file_nuovi' => 'nullable',
            'is_cancellato' => 'nullable',

            'avvio_servizio_at' => 'nullable',
            'avvio_progettazione_at' => 'nullable',
            'fte_at' => 'nullable',
            'def_at' => 'nullable',
            'ese_at' => 'nullable',
            'cds_avvio_at' => 'nullable',
            'cds_chiusa_at' => 'nullable',
            'contratto_at' => 'nullable',
            'consegna_lavori_at' => 'nullable',
            'cre_at' => 'nullable',
            'check_at' => 'nullable',
            'modifica_at' => 'nullable',
            'scadenza_progetto_at' => 'nullable',
            'scadenza_affidamento_at' => 'nullable',
            'scadenza_esecuzione_at' => 'nullable|date',

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
        $validated['is_bdap'] = $request->has('is_bdap');
        $validated['is_bdap_convalidato'] = $request->has('is_bdap_convalidato');
        $validated['is_sito_internet'] = $request->has('is_sito_internet');
        $validated['is_cancellato'] = $request->has('is_cancellato');



        // 2. Aggiorna il modello
        $practice->update($validated);
        // $practice->update();

        // 3. Ritorna alla lista o al dettaglio con un messaggio di successo
        return redirect()->route('practices.edit', $practice)->with('status', 'practice aggiornato con successo!');
    }
}
