<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = [
            [
                "id" => 1,
                "placas" => "ABC-123",
                "marca" => "Toyota",
                "modelo" => "Corolla",
                "cliente" => "Juan Perez"
            ],
            [
                "id" => 2,
                "placas" => "XYZ-456",
                "marca" => "Nissan",
                "modelo" => "Versa",
                "cliente" => "Maria Lopez"
            ]
        ];


        return view('vehiculos.index', compact('vehiculos'));
    }



    public function store(Request $request)
    {
        return response()->json([
            "mensaje" => "Vehículo registrado correctamente",
            "datos" => $request->all()
        ]);
    }



    public function show($id)
    {
        return response()->json([
            "mensaje" => "Vehículo encontrado",
            "id" => $id
        ]);
    }



    public function update(Request $request, $id)
    {
        return response()->json([
            "mensaje" => "Vehículo actualizado",
            "id" => $id,
            "datos" => $request->all()
        ]);
    }



    public function destroy($id)
    {
        return response()->json([
            "mensaje" => "Vehículo eliminado",
            "id" => $id
        ]);
    }



    public function detallesServicios($id)
    {
        $vehiculo = [
            "id" => "03",
            "placas" => "L80Y-CD56",
            "marca" => "CHEVROLET",
            "modelo" => "chevi-2008",
            "cliente" => "MARCOS ACOSTA MORALES",
            "kilometraje" => "56,057 KM",
            "fecha_ingreso" => "07-08-2026"
        ];


        $servicios = [
            [
                "fecha" => "07/08/26",
                "tipo" => "Preventivo",
                "descripcion" => "Cambio de aceite y filtros",
                "mecanico" => "PEDRO CERON-motores",
                "kilometraje" => "56,057",
                "costo" => "1,300"
            ]
        ];


        return view('vehiculos.detalles-servicios', compact('vehiculo', 'servicios'));
    }

    public function nuevoMantenimiento($id)
{
    $vehiculo = [
        "id" => $id,
        "placas" => "L80Y-CD56",
        "kilometraje" => "56,057 KM",
        "marca" => "CHEVROLET",
        "modelo" => "chevi-2008",
        "propietario" => "MARCOS ACOSTA MORALES",
        "fecha_ingreso" => "07-08-2026"
    ];

    return view('vehiculos.nuevo-mantenimiento', compact('vehiculo'));
}
}
