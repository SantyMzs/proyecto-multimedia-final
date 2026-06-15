<?php
include "includes/funciones.php";

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$tipo = isset($_GET["tipo"]) ? limpiar($_GET["tipo"]) : "";

if ($id === 0 && $tipo !== "") {
    if ($tipo !== "certificado" && $tipo !== "inscripcion") {
        die("Tipo de trámite no válido.");
    }

    $id = crearTramiteJSON($tipo);
    registrarSeguimientoJSON($id, "inicio", "Trámite iniciado");

    header("Location: tramite.php?id=" . $id);
    exit;
}

$tramite = obtenerTramitePorID($id);

if (!$tramite) {
    die("Trámite no encontrado.");
}

$paso = $tramite["paso"];
$tipo = $tramite["tipo"];

$pasosFlujo = obtenerPasosFlujo($tipo);
$historial = obtenerSeguimientoJSON($tramite["id"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Trámite Universitario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">
    <h1><?php echo obtenerNombreTramite($tipo); ?></h1>

    <div class="estado <?php echo claseEstado($tramite["estado"]); ?>">
        <strong>ID:</strong> <?php echo $tramite["id"]; ?> |
        <strong>Estado:</strong> <?php echo strtoupper($tramite["estado"]); ?> |
        <strong>Paso actual:</strong> <?php echo $tramite["paso"]; ?>
    </div>

    <br>
    <a class="boton-editar" href="editar.php?id=<?php echo $tramite['id']; ?>">Editar datos</a>
    <br><br>

    <h2>Flujo del trámite</h2>

    <div class="barra-pasos">
        <?php foreach ($pasosFlujo as $item) { ?>
            <?php
                $activo = "";

                if (
                    ($paso === "inicio" && $item["proceso"] === "P1") ||
                    ($paso === "documentos" && $item["proceso"] === "P2") ||
                    ($paso === "revision" && $item["proceso"] === "P3") ||
                    (($paso === "aceptar" || $paso === "rechazar") && $item["proceso"] === "P4")
                ) {
                    $activo = "paso-activo";
                }
            ?>

            <div class="paso <?php echo $activo; ?>">
                <span><?php echo $item["proceso"]; ?></span>
                <p><?php echo $item["nombre"]; ?></p>
            </div>
        <?php } ?>
    </div>

    <hr>

    <?php
    if ($paso === "inicio" && $tipo === "certificado") {
        include "vistas/certificado.inc.php";
    } elseif ($paso === "inicio" && $tipo === "inscripcion") {
        include "vistas/inscripcion.inc.php";
    } elseif ($paso === "documentos") {
        include "vistas/documentos.inc.php";
    } elseif ($paso === "revision") {
        include "vistas/revision.inc.php";
    } elseif ($paso === "aceptar") {
    include "vistas/aceptar.inc.php";
    } elseif ($paso === "rechazar") {
    include "vistas/rechazar.inc.php";
    } elseif ($paso === "anulado") {
    include "vistas/anulado.inc.php";
    } else {
    include "vistas/inicio.inc.php";
    }
    ?>

    <hr>

    <h2>Historial del trámite</h2>

    <div class="historial">
        <?php if (count($historial) > 0) { ?>
            <?php foreach ($historial as $item) { ?>
                <div class="historial-item">
                    <strong><?php echo $item["paso"]; ?></strong>
                    <p><?php echo $item["estado"]; ?></p>
                    <small><?php echo $item["fecha"]; ?></small>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No existe historial registrado.</p>
        <?php } ?>
    </div>

    <br>

    <div class="acciones-tramite">
        <a class="boton" href="bandeja.php">Volver a bandeja</a>
        <a class="boton" href="index.php">Nuevo trámite</a>
        <a class="boton-editar" href="editar.php?id=<?php echo $tramite['id']; ?>">Editar datos</a>
    </div>
</div>

<script src="js/app.js"></script>
</body>
</html>