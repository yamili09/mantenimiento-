<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIMA</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f2f2f2;
        }


        /* ================= HEADER ================= */

        header{
            background:#3b62ad;
            height:70px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:0 35px;
            color:white;
        }


        .usuario{
            display:flex;
            align-items:center;
        }


        .icono{
            font-size:32px;
            margin-right:12px;
        }


        .nombre{
            font-size:13px;
            font-weight:bold;
        }


        .cargo{
            font-size:12px;
        }


        nav a{
            color:white;
            text-decoration:none;
            margin-left:35px;
            font-size:17px;
            font-weight:bold;
            padding-bottom:6px;
            transition:.3s;
        }


        nav a:hover{
            border-bottom:3px solid white;
        }


        /* ================= CONTENIDO ================= */

        .contenedor{
            width:95%;
            margin:25px auto;
        }


    </style>

</head>


<body>


<header>

    <div class="usuario">

        <div class="icono">
            👤
        </div>

        <div>

            <div class="nombre">
                FERNANDO OSORIO
            </div>

            <div class="cargo">
                Administrador
            </div>

        </div>

    </div>


    <nav>

        <a href="#">Inicio</a>
        <a href="#">Registros</a>
        <a href="#">Inventario</a>
        <a href="#">Administración</a>
        <a href="#">Configuración</a>

    </nav>


</header>



<div class="contenedor">

    @yield('contenido')

</div>



</body>

</html>