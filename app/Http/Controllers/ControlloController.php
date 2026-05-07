<?php
namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class ControlloController extends Controller
{


    public function updateBuffer(Request $request)
    {
        $items = $request->input('items');

        try {
            DB::transaction(function () use ($items) {
                foreach ($items as $item) {

                    Practice::updateOrCreate(
                        ['id' => $item['idPractice']],
                        [
                            'file_effettivi_count' => $item['totalFiles'],
                            'file_nuovi' => $item['recentFiles'],
                            'check_at' => $item['dateCheck'],
                        ]
                    );
                }
            });

            return response()->json([
                'status' => 'success',
                'message' => count($items) . ' pratiche aggiornate.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }





    public function index(Request $request): View
    {

        $practices = Practice::where('is_in_corso', true)
            ->where('is_avvio_progettazione', true)
            ->orderBy("codice", "desc")
            ->get();

        return view("controllo.index", compact("practices"));
    }

    // Elenca tutte le pratiche senza filtri
    public function nuovePratiche(Request $request): View
    {
        $practices = Practice::orderBy("codice", "desc")
            ->get();

        return view("controllo.nuove-pratiche", compact("practices"));
    }


    /**
     * Aggiunge le nuove cartelle trovate come nuove pratiche su DB
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCartelle(Request $request)
    {
        $items = $request->input('items');

        try {
            DB::transaction(function () use ($items) {
                foreach ($items as $item) {

                    Practice::updateOrCreate(
                        ['id' => null],  // Si tratta di un inserimento e non ho un id da controllare se esiste
                        [
                            'codice' => $item['codice'],
                            'is_in_corso' => $item['is_in_corso'],
                        ]
                    );
                }
            });

            return response()->json([
                'status' => 'success',
                'message' => count($items) . ' pratiche aggiornate.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }


}
