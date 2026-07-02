<?php
namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Busca 'home.blade.php' directamente en views
    public function index() {
        $user = Auth::user();
        
        // Datos simulados o de base de datos para tus tarjetas de resumen
        $totalVehiculos = Vehicle::count() ?: 14;
        $enServicio = Vehicle::where('status', 'en_servicio')->count() ?: 8;
        $esperaRefaccion = Vehicle::where('status', 'espera_refaccion')->count() ?: 3;
        $terminados = Vehicle::where('status', 'terminado')->count() ?: 3;

        return view('home', compact('user', 'totalVehiculos', 'enServicio', 'esperaRefaccion', 'terminados'));
    }
}