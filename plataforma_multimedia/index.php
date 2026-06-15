<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma Multimedia</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f7;
            color: #1f2937;
        }

        header {
            background: linear-gradient(135deg, #1d3557, #457b9d);
            color: white;
            padding: 35px 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 38px;
        }

        header p {
            margin-top: 10px;
            font-size: 18px;
        }

        .contenedor {
            width: 90%;
            max-width: 1150px;
            margin: 35px auto;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 22px;
        }

        .tarjeta {
            background: white;
            padding: 25px;
            border-radius: 18px;
            text-decoration: none;
            color: #1f2937;
            box-shadow: 0 8px 18px rgba(0,0,0,0.12);
            border-top: 6px solid #1d3557;
            transition: 0.25s;
        }

        .tarjeta:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.18);
        }

        .tarjeta h2 {
            margin-top: 0;
            color: #1d3557;
            font-size: 22px;
        }

        .tarjeta p {
            line-height: 1.5;
            font-size: 15px;
        }

        .estado {
            display: inline-block;
            margin-top: 12px;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .hecho {
            background: #dcfce7;
            color: #166534;
        }

        .pendiente {
            background: #fef3c7;
            color: #92400e;
        }

        .seccion {
            margin-top: 40px;
            background: white;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.10);
        }

        .seccion h2 {
            margin-top: 0;
            color: #1d3557;
        }

        footer {
            text-align: center;
            padding: 20px;
            margin-top: 35px;
            background: #1d3557;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <h1>Plataforma Multimedia</h1>
    <p>Proyecto de digitalización, procesamiento de imágenes, animación y fotogrametría</p>
</header>

<div class="contenedor">

    <div class="grid">

        <a class="tarjeta" href="../proyecto_multimedia/">
            <h2>Workflow PHP + JSON</h2>
            <p>
                Sistema de digitalización de trámites universitarios usando PHP y archivos JSON,
                sin servidor de base de datos tradicional.
            </p>
            <span class="estado hecho">Terminado</span>
        </a>

        <a class="tarjeta" href="unity_final/index.html">
            <h2>Animación Unity WebGL</h2>
            <p>
                Escena 3D desarrollada en Unity con personajes realizando una coreografía
                sincronizada con música y exportada a WebGL.
            </p>
            <span class="estado hecho">Terminado</span>
        </a>

        <a class="tarjeta" href="../procesamiento_imagenes/">
            <h2>Procesamiento de Imágenes</h2>
            <p>
                Clasificación de texturas y filtro de suavizado promedio 3x3 trabajando
                directamente a nivel de píxel con Python.
            </p>
            <span class="estado hecho">Terminado</span>
        </a>

        <a class="tarjeta" href="../cover_vaca_lola/">
            <h2>Cover Vaca Lola</h2>
            <p>
                Producción multimedia generada en Google Colab con audio y animación
                coordinada mediante Python.
            </p>
            <span class="estado hecho">Terminado</span>
        </a>

        <a class="tarjeta" href="../fotogrametria_avatar/">
            <h2>Fotogrametría COLMAP</h2>
            <p>
                Reconstrucción tridimensional de un integrante del grupo mediante múltiples
                fotografías procesadas con COLMAP.
            </p>
            <span class="estado hecho">Terminado</span>
        </a>

    </div>


</div>

<footer>
    Proyecto Multimedia - Plataforma Web Funcional
</footer>

</body>
</html>