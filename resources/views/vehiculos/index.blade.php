@extends('layouts.app')

@section('contenido')

<style>

.titulo{
    color:#2f5aa8;
    font-size:28px;
    font-weight:bold;
    margin-bottom:25px;
}

.barra-superior{

    display:flex;
    justify-content:space-between;
    align-items:center;
    width:96%;
    margin:0 auto 30px auto;

}

.filtro,
.buscar{

    border:2px solid #2f5aa8;
    border-radius:20px;
    padding:10px 15px;
    outline:none;
    font-size:15px;

}

.filtro{
    width:150px;
}

.buscar{
    width:380px;
}

table{

    width:96%;
    margin:auto;
    border-collapse:collapse;

}

thead{

    background:#2f5aa8;
    color:white;

}

th{

    padding:12px;
    font-size:18px;
    border:2px solid #466db7;

}

td{

    padding:12px;
    border:2px solid #466db7;
    vertical-align:top;

}

.btn{

    border:none;
    color:white;
    width:72px;
    height:26px;
    font-size:13px;
    cursor:pointer;
    margin:2px;

}

.eliminar{

    background:#d62828;

}

.editar{

    background:#ffd43b;
    color:black;

}

.detalles{

    background:#4169e1;

}

.nuevo{

    background:#3cb043;

}

.btn-registro{

    margin-top:45px;
    width:360px;
    height:60px;
    background:#2f5aa8;
    color:white;
    border:none;
    border-radius:30px;
    font-size:22px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;

}

.btn-registro:hover{

    background:#24498d;

}

</style>

<h2 class="titulo">

TABLA DE REGISTROS

</h2>

<div class="barra-superior">

<input class="filtro" type="text" placeholder="Filtrar">

<div style="position:relative;">

    <input class="buscar" type="text" placeholder="Buscar registro de vehículo">

    <span style="
        position:absolute;
        right:15px;
        top:10px;
        font-size:20px;
        color:#2f5aa8;
    ">🔍</span>

</div>

</div>

<table>

<thead>

<tr>

<th>ID</th>
<th>Placas</th>
<th>Fabricante</th>
<th>Modelo</th>
<th>Cliente</th>
<th>Mecánico</th>
<th>ACCIONES</th>

</tr>

</thead>

<tbody>

<tr>

<td>01</td>
<td>X34G-HT23</td>
<td>NISSAN</td>
<td>VERSA</td>
<td>JUAN HERNÁNDEZ PÉREZ</td>
<td>ROBERTO ITZA</td>

<td>

<button class="btn eliminar">Eliminar</button>

<button class="btn editar">Editar</button>

<button class="btn detalles">Detalles</button>

<button class="btn nuevo">Nuevo</button>

</td>

</tr>

<tr>

<td>02</td>
<td>P12J-LU25</td>
<td>HONDA</td>
<td>HILUX 4X4 TR</td>
<td>MANUEL VALLEJOS SANSORES</td>
<td>MARIO MARTÍNEZ</td>

<td>

<button class="btn eliminar">Eliminar</button>

<button class="btn editar">Editar</button>

<button class="btn detalles">Detalles</button>

<button class="btn nuevo">Nuevo</button>

</td>

</tr>

<tr>

<td>03</td>
<td>L80Y-CD56</td>
<td>CHEVROLET</td>
<td>CHEVI</td>
<td>MARCOS ACOSTA MORALES</td>
<td>PEDRO CERÓN</td>

<td>

<button class="btn eliminar">Eliminar</button>

<button class="btn editar">Editar</button>

<button class="btn detalles">Detalles</button>

<button class="btn nuevo">Nuevo</button>

</td>

</tr>

</tbody>

</table>

<center>

<button class="btn-registro">

Nuevo registro +

</button>

</center>

@endsection