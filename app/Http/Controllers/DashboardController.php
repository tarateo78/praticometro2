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

        // $user = User::find( auth()->user()->id  );
        $user =  auth()->user();
        $practices = $user->practices;

        return view("dashboard", compact("practices"));
    }

    
}
