<?php
include "includes/funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Digitalización de Trámites UMSA</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Sistema de Digitalización de Trámites Universitarios</h1>
    <p>Seleccione el trámite que desea realizar:</p>

    <div class="tarjetas">
        <a class="tarjeta" href="tramite.php?tipo=certificado">
            <h2>Certificado de Notas</h2>
            <p>Solicitud digital de certificado académico.</p>
        </a>

        <a class="tarjeta" href="tramite.php?tipo=inscripcion">
            <h2>Inscripción de Materias</h2>
            <p>Registro digital para inscripción de materias.</p>
        </a>
        
    </div>

    <br>
    <a class="boton" href="bandeja.php">Ver bandeja de trámites</a>
</div>

</body>
</html>