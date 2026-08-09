@extends('layouts.app')

@section('contenido')

<style>

    .mantenimiento-contenido {
        width: 90%;
        margin: 0 auto;
    }

    .logo-sima {
        font-size: 12px;
        font-weight: bold;
        color: #315ca8;
        margin-bottom: 5px;
    }

    .logo-texto {
        font-size: 5px;
        display: inline-block;
        line-height: 1;
        vertical-align: middle;
        margin-left: 2px;
    }

    .titulo-mantenimiento {
        text-align: center;
        color: #315ca8;
        font-size: 21px;
        font-weight: bold;
        margin: 5px 0 25px;
    }

    .titulo-seccion {
        color: #315ca8;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .datos-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        column-gap: 70px;
        row-gap: 25px;
        margin-bottom: 28px;
    }

    .dato {
        display: flex;
        flex-direction: column;
    }

    .dato-label {
        color: #315ca8;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 2px;
    }

    .dato-valor {
        color: #20c45a;
        font-size: 13px;
        font-weight: bold;
        line-height: 1.1;
    }

    .formulario-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        column-gap: 70px;
    }

    .campo-tipo {
        grid-column: 1 / 3;
    }

    .campo-mecanico {
        grid-column: 3;
    }

    .campo-descripcion {
        grid-column: 1 / 4;
        margin-top: 8px;
    }

    .campo-label {
        display: block;
        color: #315ca8;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .opciones {
        display: flex;
        gap: 70px;
        align-items: center;
    }

    .opcion {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #315ca8;
        font-size: 13px;
        font-style: italic;
    }

    .opcion input {
        appearance: none;
        width: 21px;
        height: 21px;
        border: 2px solid #315ca8;
        background: #f2f2f2;
        cursor: pointer;
    }

    .opcion input:checked {
        background: #315ca8;
        box-shadow: inset 0 0 0 4px #f2f2f2;
    }

    .mecanico-boton {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .btn-asignar {
        width: 116px;
        height: 36px;
        border: none;
        border-radius: 5px;
        background: #315ca8;
        color: white;
        font-weight: bold;
        font-size: 13px;
        cursor: pointer;
    }

    .alerta {
        color: red;
        font-size: 20px;
        font-weight: bold;
    }

    .descripcion {
        width: 100%;
        height: 60px;
        border: 1px solid #315ca8;
        resize: none;
        padding: 5px;
        font-size: 14px;
        color: #315ca8;
    }

    .botones {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 25px;
    }

    .btn-cancelar,
    .btn-agregar {
        width: 148px;
        height: 34px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-cancelar {
        background: #f11616;
        color: white;
        border: none;
    }

    .btn-agregar {
        background: white;
        color: #315ca8;
        border: 1px solid #315ca8;
    }

</style>


<div class="mantenimiento-contenido">

    <!-- LOGO -->
    <div class="logo-sima">
        SIMA
        <span class="logo-texto">
            SISTEMA INTEGRAL DE<br>
            MANTENIMIENTO AUTOMOTRIZ
        </span>
    </div>


    <!-- TITULO -->
    <h1 class="titulo-mantenimiento">
        NUEVO MANTENIMIENTO
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


    <!-- FORMULARIO -->
    <div class="formulario-grid">

        <!-- TIPO DE MANTENIMIENTO -->
        <div class="campo-tipo">

            <span class="campo-label">
                Selecciona el tipo de mantenimiento:
            </span>

            <div class="opciones">

                <label class="opcion">
                    <input type="checkbox" name="tipo" value="Preventivo">
                    Preventivo
                </label>

                <label class="opcion">
                    <input type="checkbox" name="tipo" value="Correctivo">
                    Correctivo
                </label>

            </div>

        </div>


        <!-- MECANICO -->
        <div class="campo-mecanico">

            <span class="campo-label">
                Asignar Mecanico
            </span>

            <div class="mecanico-boton">

                <button type="button" class="btn-asignar">
                    Asignar
                </button>

                <span class="alerta">
                    ⚠
                </span>

            </div>

        </div>


        <!-- DESCRIPCION -->
        <div class="campo-descripcion">

            <label class="campo-label">
                Descripción
            </label>

            <textarea class="descripcion" name="descripcion"></textarea>

        </div>

    </div>


    <!-- BOTONES -->
    <div class="botones">

        <button type="button" class="btn-cancelar">
            Cancelar
        </button>

        <button type="button" class="btn-agregar">
            Agregar
        </button>

        <span class="alerta">
            ⚠
        </span>

    </div>

</div>

@endsection