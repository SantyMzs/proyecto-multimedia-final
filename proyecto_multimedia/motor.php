<?php
include "includes/funciones.php";

if (!isset($_POST["id"])) {
    header("Location: index.php");
    exit;
}

$id = intval($_POST["id"]);
$accion = isset($_POST["accion"]) ? limpiar($_POST["accion"]) : "";

$tramite = obtenerTramitePorID($id);

if (!$tramite) {
    die("Trámite no encontrado.");
}

if ($accion === "actualizar_datos") {
    $datos = limpiar($_POST);

    unset($datos["id"]);
    unset($datos["accion"]);
    unset($datos["motivo_edicion"]);

    $motivo_edicion = isset($_POST["motivo_edicion"]) ? limpiar($_POST["motivo_edicion"]) : "Edición sin detalle.";

    actualizarTramiteJSON($id, [
        "nombre" => limpiar($_POST["nombre"]),
        "ci" => limpiar($_POST["ci"]),
        "carrera" => limpiar($_POST["carrera"]),
        "correo" => limpiar($_POST["correo"]),
        "datos" => $datos,
        "estado" => "pendiente",
        "paso" => "revision",
        "observacion" => "Datos modificados. Requiere nueva revisión."
    ]);

    registrarSeguimientoJSON(
        $id,
        "edicion",
        "Datos del trámite editados. Motivo: " . $motivo_edicion
    );

    header("Location: tramite.php?id=$id");
    exit;
}

if ($accion === "guardar_datos") {
    $datos = limpiar($_POST);

    unset($datos["id"]);
    unset($datos["accion"]);

    actualizarTramiteJSON($id, [
        "nombre" => limpiar($_POST["nombre"]),
        "ci" => limpiar($_POST["ci"]),
        "carrera" => limpiar($_POST["carrera"]),
        "correo" => limpiar($_POST["correo"]),
        "datos" => $datos,
        "estado" => "pendiente",
        "paso" => "documentos"
    ]);

    registrarSeguimientoJSON($id, "documentos", "Datos registrados");

    header("Location: tramite.php?id=$id");
    exit;
}

if ($accion === "guardar_documentos") {
    $documentos = isset($_POST["documentos"]) ? limpiar($_POST["documentos"]) : [];

    actualizarTramiteJSON($id, [
        "documentos" => $documentos,
        "paso" => "revision"
    ]);

    registrarSeguimientoJSON($id, "revision", "Documentos enviados para revisión");

    header("Location: tramite.php?id=$id");
    exit;
}

if ($accion === "aprobar") {
    $observacion = "El trámite fue aprobado correctamente.";

    actualizarTramiteJSON($id, [
        "estado" => "aprobado",
        "paso" => "aceptar",
        "observacion" => $observacion
    ]);

    registrarSeguimientoJSON($id, "aceptar", "Trámite aprobado");

    header("Location: tramite.php?id=$id");
    exit;
}

if ($accion === "rechazar") {
    $observacion = isset($_POST["observacion"]) && trim($_POST["observacion"]) !== ""
        ? limpiar($_POST["observacion"])
        : "El trámite fue rechazado por observaciones en la documentación.";

    actualizarTramiteJSON($id, [
        "estado" => "rechazado",
        "paso" => "rechazar",
        "observacion" => $observacion
    ]);

    registrarSeguimientoJSON($id, "rechazar", "Trámite rechazado. Motivo: " . $observacion);

    header("Location: tramite.php?id=$id");
    exit;

}
if ($accion === "anular") {
    $motivo_anulacion = isset($_POST["motivo_anulacion"]) && trim($_POST["motivo_anulacion"]) !== ""
        ? limpiar($_POST["motivo_anulacion"])
        : "Trámite anulado por solicitud del usuario.";

    actualizarTramiteJSON($id, [
        "estado" => "anulado",
        "paso" => "anulado",
        "observacion" => $motivo_anulacion
    ]);

    registrarSeguimientoJSON(
        $id,
        "anulacion",
        "Trámite anulado. Motivo: " . $motivo_anulacion
    );

    header("Location: tramite.php?id=$id");
    exit;
}

header("Location: index.php");
exit;
?>