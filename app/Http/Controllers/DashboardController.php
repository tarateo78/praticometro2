<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{


    public function index(Request $request): View
    {

        $start = [];
        $prog = [];
        $cds = [];
        $gara = [];
        $lavori = [];
        $cre = [];

        // $user = User::find( auth()->user()->id  );
        $user = auth()->user();
        $practices = $user->practices;

        foreach ($practices as $prac) {
            if (!$prac->is_avvio_progettazione) {
                array_push($start, $prac);
            }
            if ($prac->is_avvio_progettazione && !$prac->is_avvio_gara) {
                array_push($prog, $prac);
            }
            if ($prac->is_cds) {
                array_push($cds, $prac);
            }
            if ($prac->is_avvio_gara && !$prac->is_lavori_in_corso) {
                array_push($gara, $prac);
            }
            if ($prac->is_lavori_in_corso && !$prac->is_cre) {
                array_push($lavori, $prac);
            }
            if ($prac->is_cre) {
                array_push($cre, $prac);
            }
        }

        return view("dashboard", compact("start", "prog", "cds", "gara", "lavori", "cre"));
    }


    public function swapUserPractice(Request $request)
    {
        $id = $request->input('id');
        $azione = $request->input('azione');
        $stato = $request->input('stato');


        $user = auth()->user();

        if ($stato) {
            $user->practices()->attach($id);
            // $user->pratiche()->attach($praticaId, [
            //     'note' => 'Assegnata manualmente',
            //     'priorita' => 2
            // ]);
        } else {
            $user->practices()->detach($id);
        }

        return response()->json([
            'success' => true,
            'messaggio' => "Operazione $azione eseguita su ID $id, stato: $stato"
        ]);
    }


}
