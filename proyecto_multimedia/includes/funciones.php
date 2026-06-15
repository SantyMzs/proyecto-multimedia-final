<?php
date_default_timezone_set("America/La_Paz");

/* ===============================
   LIMPIEZA DE DATOS
================================ */

function limpiar($dato) {
    if (is_array($dato)) {
        return array_map("limpiar", $dato);
    }

    return htmlspecialchars(trim($dato), ENT_QUOTES, "UTF-8");
}

function minuscula($texto) {
    if (function_exists("mb_strtolower")) {
        return mb_strtolower($texto, "UTF-8");
    }

    return strtolower($texto);
}

/* ===============================
   FUNCIONES JSON
================================ */

function rutaJSON($archivo) {
    return __DIR__ . "/../data/" . $archivo;
}

function leerJSON($archivo) {
    $ruta = rutaJSON($archivo);

    if (!file_exists($ruta)) {
        return [];
    }

    $contenido = file_get_contents($ruta);

    if (trim($contenido) === "") {
        return [];
    }

    $datos = json_decode($contenido, true);

    if (!is_array($datos)) {
        return [];
    }

    return $datos;
}

function escribirJSON($archivo, $datos) {
    $ruta = rutaJSON($archivo);
    $json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($ruta, $json, LOCK_EX);
}

function obtenerSiguienteID($archivo) {
    $datos = leerJSON($archivo);
    $mayor = 0;

    foreach ($datos as $item) {
        if (isset($item["id"]) && intval($item["id"]) > $mayor) {
            $mayor = intval($item["id"]);
        }
    }

    return $mayor + 1;
}

/* ===============================
   TRÁMITES JSON
================================ */

function crearTramiteJSON($tipo) {
    $tramites = leerJSON("tramites.json");
    $id = obtenerSiguienteID("tramites.json");

    $nuevo = [
        "id" => $id,
        "tipo" => $tipo,
        "nombre" => "",
        "ci" => "",
        "carrera" => "",
        "correo" => "",
        "datos" => [],
        "documentos" => [],
        "estado" => "pendiente",
        "paso" => "inicio",
        "observacion" => "",
        "fecha_creacion" => date("Y-m-d H:i:s")
    ];

    $tramites[] = $nuevo;
    escribirJSON("tramites.json", $tramites);

    return $id;
}

function obtenerTramitePorID($id) {
    $tramites = leerJSON("tramites.json");

    foreach ($tramites as $tramite) {
        if (isset($tramite["id"]) && intval($tramite["id"]) === intval($id)) {
            return $tramite;
        }
    }

    return null;
}

function actualizarTramiteJSON($id, $campos) {
    $tramites = leerJSON("tramites.json");
    $encontrado = false;

    foreach ($tramites as $i => $tramite) {
        if (isset($tramite["id"]) && intval($tramite["id"]) === intval($id)) {
            $tramites[$i] = array_merge($tramite, $campos);
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        $nuevo = array_merge([
            "id" => intval($id),
            "tipo" => "",
            "nombre" => "",
            "ci" => "",
            "carrera" => "",
            "correo" => "",
            "datos" => [],
            "documentos" => [],
            "estado" => "pendiente",
            "paso" => "inicio",
            "observacion" => "",
            "fecha_creacion" => date("Y-m-d H:i:s")
        ], $campos);

        $tramites[] = $nuevo;
    }

    escribirJSON("tramites.json", $tramites);
}

function obtenerTramitesJSON($estado = "", $buscar = "") {
    $tramites = leerJSON("tramites.json");
    $resultado = [];

    $estado = limpiar($estado);
    $buscar = minuscula(limpiar($buscar));

    foreach ($tramites as $tramite) {
        $cumpleEstado = true;
        $cumpleBusqueda = true;

        if ($estado !== "") {
            $cumpleEstado = isset($tramite["estado"]) && $tramite["estado"] === $estado;
        }

        if ($buscar !== "") {
            $texto = "";
            $texto .= isset($tramite["tipo"]) ? $tramite["tipo"] . " " : "";
            $texto .= isset($tramite["nombre"]) ? $tramite["nombre"] . " " : "";
            $texto .= isset($tramite["ci"]) ? $tramite["ci"] . " " : "";
            $texto .= isset($tramite["carrera"]) ? $tramite["carrera"] . " " : "";

            $cumpleBusqueda = strpos(minuscula($texto), $buscar) !== false;
        }

        if ($cumpleEstado && $cumpleBusqueda) {
            $resultado[] = $tramite;
        }
    }

    usort($resultado, function($a, $b) {
        $fechaA = isset($a["fecha_creacion"]) ? $a["fecha_creacion"] : "";
        $fechaB = isset($b["fecha_creacion"]) ? $b["fecha_creacion"] : "";
        return strcmp($fechaB, $fechaA);
    });

    return $resultado;
}

/* ===============================
   SEGUIMIENTO JSON
================================ */

function registrarSeguimientoJSON($tramite_id, $paso, $estado) {
    $seguimiento = leerJSON("seguimiento.json");

    $seguimiento[] = [
        "id" => obtenerSiguienteID("seguimiento.json"),
        "tramite_id" => intval($tramite_id),
        "paso" => limpiar($paso),
        "estado" => limpiar($estado),
        "fecha" => date("Y-m-d H:i:s")
    ];

    escribirJSON("seguimiento.json", $seguimiento);
}

function obtenerSeguimientoJSON($tramite_id) {
    $seguimiento = leerJSON("seguimiento.json");
    $resultado = [];

    foreach ($seguimiento as $item) {
        if (isset($item["tramite_id"]) && intval($item["tramite_id"]) === intval($tramite_id)) {
            $resultado[] = $item;
        }
    }

    usort($resultado, function($a, $b) {
        $fechaA = isset($a["fecha"]) ? $a["fecha"] : "";
        $fechaB = isset($b["fecha"]) ? $b["fecha"] : "";
        return strcmp($fechaA, $fechaB);
    });

    return $resultado;
}

/* ===============================
   FLUJO BPM
================================ */

function obtenerPasosFlujo($tipo) {
    $flujos = leerJSON("flujoproceso.json");
    $pasos = [];

    foreach ($flujos as $flujo) {
        if (isset($flujo["tipo_tramite"]) && $flujo["tipo_tramite"] === $tipo) {
            $pasos[] = $flujo;
        }
    }

    return $pasos;
}

/* ===============================
   NOMBRES Y ESTADOS
================================ */

function obtenerNombreTramite($tipo) {
    if ($tipo === "certificado") {
        return "Certificado de Notas";
    }

    if ($tipo === "inscripcion") {
        return "Inscripción de Materias";
    }

    return ucfirst($tipo);
}

function claseEstado($estado) {
    if ($estado === "aprobado") {
        return "estado-aprobado";
    }

    if ($estado === "rechazado") {
        return "estado-rechazado";
    }

    if ($estado === "anulado") {
        return "estado-anulado";
    }

    return "estado-pendiente";
}
function valorDato($datos, $clave) {
    if (is_array($datos) && isset($datos[$clave])) {
        return $datos[$clave];
    }

    return "";
}
?>