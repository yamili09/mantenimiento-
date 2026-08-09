@extends('layouts.app')

@section('contenido')

<style>
    .detalles-container {
        width: 95%;
        margin: 0 auto;
    }

    /* LOGO */
    .logo-sima {
        margin-top: 5px;
        color: #3b62ad;
        font-size: 22px;
        font-weight: bold;
        font-style: italic;
    }

    .logo-texto {
        display: inline-block;
        font-size: 7px;
        font-style: normal;
        line-height: 8px;
        margin-left: 5px;
        vertical-align: middle;
    }

    /* TITULO */
    .titulo-detalles {
        text-align: center;
        color: #3b62ad;
        font-size: 24px;
        font-weight: bold;
        margin: 0 0 25px 0;
    }

    /* DATOS DEL VEHICULO */
    .titulo-seccion {
        color: #3b62ad;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .datos-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        column-gap: 70px;
        row-gap: 25px;
        margin-bottom: 12px;
    }

    .dato {
        min-height: 55px;
    }

    .dato-label {
        display: block;
        color: #3b62ad;
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 4px;
    }

    .dato-valor {
        display: block;
        color: #18bd59;
        font-size: 15px;
        line-height: 18px;
    }

    /* HISTORIAL */
    .historial-titulo {
        color: #3b62ad;
        font-size: 15px;
        margin: 5px 0 22px 0;
    }

    .tabla-servicios {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .tabla-servicios th {
        background: #496fb6;
        color: white;
        border: 1px solid #315da8;
        padding: 5px 6px;
        font-size: 16px;
        line-height: 20px;
        text-align: center;
        vertical-align: middle;
    }

    .tabla-servicios td {
        border: 1px solid #315da8;
        color: #3b62ad;
        padding: 7px 6px;
        font-size: 16px;
        line-height: 19px;
        text-align: center;
        vertical-align: top;
        height: 80px;
    }

    .tabla-servicios th:nth-child(1) {
        width: 12%;
    }

    .tabla-servicios th:nth-child(2) {
        width: 14%;
    }

    .tabla-servicios th:nth-child(3) {
        width: 17%;
    }

    .tabla-servicios th:nth-child(4) {
        width: 16%;
    }

    .tabla-servicios th:nth-child(5) {
        width: 16%;
    }

    .tabla-servicios th:nth-child(6) {
        width: 13%;
    }

    .tabla-servicios th:nth-child(7) {
        width: 14%;
    }

    /* BOTONES */
    .acciones {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }

    .btn-eliminar {
        background: #d71919;
        color: white;
        border: none;
        padding: 2px 7px;
        font-size: 13px;
        cursor: pointer;
    }

    .btn-editar {
        background: #22bd5d;
        color: white;
        border: none;
        padding: 2px 15px;
        font-size: 13px;
        cursor: pointer;
    }

    /* RESUMEN */
    .resumen {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 120px;
        border: 1px solid #c7d2e5;
        margin-top: 13px;
        min-height: 60px;
    }

    .resumen-item {
        text-align: center;
        padding: 7px 5px;
        border-right: 1px solid #c7d2e5;
    }

    .resumen-titulo {
        display: block;
        color: #3b62ad;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 2px;
    }

    .resumen-verde {
        color: #18bd59;
        font-size: 14px;
    }

    .resumen-rojo {
        color: #ef2b2b;
        font-size: 14px;
    }

    .nuevo-mantenimiento {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: #3b62ad;
    color: white;
    border-radius: 7px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    line-height: 17px;
    margin: 5px;
    padding: 6px;
}

.flecha {
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    color: #3b62ad;
    font-size: 20px;
    width: 27px;
    height: 27px;
    margin: 0;
    padding: 0;
    border-radius: 3px;
    flex-shrink: 0;
}
</style>


<div class="detalles-container">

    <!-- LOGO -->
    <div class="logo-sima">
        SIMA
        <span class="logo-texto">
            SISTEMA INTEGRAL DE<br>
            MANTENIMIENTO AUTOMOTRIZ
        </span>
    </div>


    <!-- TITULO -->
    <h1 class="titulo-detalles">
        DETALLES DE SERVICIOS
    </h1>


    <!-- DATOS DEL VEHICULO -->
    <div class="titulo-seccion">
        DATOS DEL VEHÍCULO
    </div>


    <div class="datos-grid">

        <div class="dato">
            <span class="dato-label">ID</span>
            <span class="dato-valor">{{ $vehiculo['id'] }}</span>
        </div>

        <div class="dato">
            <span class="dato-label">Placa</span>
            <span class="dato-valor">{{ $vehiculo['placas'] }}</span>
        </div>

        <div class="dato">
            <span class="dato-label">Kilometraje actual</span>
            <span class="dato-valor">{{ $vehiculo['kilometraje'] }}</span>
        </div>

        <div class="dato">
            <span class="dato-label">Vehículo</span>
            <span class="dato-valor">
               {{ $vehiculo['marca'] }}<br>
    {{ $vehiculo['modelo'] }}
            </span>
        </div>

        <div class="dato">
            <span class="dato-label">Propietario</span>
            <span class="dato-valor">
                MARCOS ACOSTA<br>
                MORALES
            </span>
        </div>

        <div class="dato">
            <span class="dato-label">Fecha de ingreso al sistema</span>
            <span class="dato-valor">{{ $vehiculo['fecha_ingreso'] }}</span>
        </div>

    </div>


    <!-- HISTORIAL -->
    <div class="historial-titulo">
        Historial de servicios
    </div>


    <table class="tabla-servicios">

        <thead>
            <tr>
                <th>Fecha<br>del<br>servicio</th>
                <th>Tipo de<br>servicio</th>
                <th>Descripción</th>
                <th>Mecánico<br>asignado</th>
                <th>kilometraje</th>
                <th>Costo</th>
                <th>Acciones</th>
            </tr>
        </thead>


        <tbody>

            <tr>

                <td>
    {{ $servicios[0]['fecha'] }}
</td>

<td>
    {{ $servicios[0]['tipo'] }}
</td>

<td>
    {{ $servicios[0]['descripcion'] }}
</td>

<td>
    {{ $servicios[0]['mecanico'] }}
</td>

<td>
    {{ $servicios[0]['kilometraje'] }}
</td>

<td>
    {{ $servicios[0]['costo'] }}
</td>
                <td>

                    <div class="acciones">

                        <button class="btn-eliminar">
                            Eliminar
                        </button>

                        <button class="btn-editar">
                            Editar
                        </button>

                    </div>

                </td>

            </tr>

        </tbody>

    </table>


    <!-- RESUMEN -->
    <div class="resumen">

        <div class="resumen-item">

            <span class="resumen-titulo">
                Servicios Realizados
            </span>

            <span class="resumen-verde">
                1
            </span>

        </div>


        <div class="resumen-item">

            <span class="resumen-titulo">
                Próximo servicio
            </span>

            <span class="resumen-rojo">
                -Pendiente
            </span>

        </div>


        <div class="resumen-item">

            <span class="resumen-titulo">
                Estado del vehículo
            </span>

            <span class="resumen-rojo">
                En el taller
            </span>

        </div>


       <a href="{{ route('mantenimiento.nuevo', $vehiculo['id']) }}" class="nuevo-mantenimiento">
    Nuevo<br>
    Mantenimiento
</a>

    </div>

</div>


@endsection