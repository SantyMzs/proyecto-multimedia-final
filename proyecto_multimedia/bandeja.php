<?php
include "includes/funciones.php";

$filtro = isset($_GET["estado"]) ? limpiar($_GET["estado"]) : "";
$buscar = isset($_GET["buscar"]) ? limpiar($_GET["buscar"]) : "";

$tramites = obtenerTramitesJSON($filtro, $buscar);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bandeja de Trámites</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Bandeja de Trámites</h1>
    <p>Lista de trámites registrados en archivos JSON.</p>

    <form method="GET" action="bandeja.php" class="form-filtros">
        <input type="text" name="buscar" placeholder="Buscar por nombre, CI o trámite" value="<?php echo $buscar; ?>">

        <select name="estado">
            <option value="">Todos los estados</option>
            <option value="pendiente" <?php if ($filtro === "pendiente") echo "selected"; ?>>Pendiente</option>
            <option value="aprobado" <?php if ($filtro === "aprobado") echo "selected"; ?>>Aprobado</option>
            <option value="rechazado" <?php if ($filtro === "rechazado") echo "selected"; ?>>Rechazado</option>
            <option value="anulado" <?php if ($filtro === "anulado") echo "selected"; ?>>Anulado</option>
        </select>

        <button type="submit">Filtrar</button>
        <a class="boton-secundario" href="bandeja.php">Limpiar</a>
    </form>

    <br>

    <table>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>CI</th>
            <th>Estado</th>
            <th>Paso</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>

        <?php if (count($tramites) > 0) { ?>
            <?php foreach ($tramites as $fila) { ?>
                <tr>
                    <td><?php echo $fila["id"]; ?></td>
                    <td><?php echo obtenerNombreTramite($fila["tipo"]); ?></td>
                    <td><?php echo $fila["nombre"]; ?></td>
                    <td><?php echo $fila["ci"]; ?></td>
                    <td>
                        <span class="badge <?php echo claseEstado($fila["estado"]); ?>">
                            <?php echo strtoupper($fila["estado"]); ?>
                        </span>
                    </td>
                    <td><?php echo $fila["paso"]; ?></td>
                    <td><?php echo $fila["fecha_creacion"]; ?></td>
                    <td>
                        <a href="tramite.php?id=<?php echo $fila["id"]; ?>">Abrir</a>
                        |
                        <a href="editar.php?id=<?php echo $fila["id"]; ?>">Editar</a>

                        <?php if ($fila["estado"] !== "anulado") { ?>
                            <form method="POST" action="motor.php" class="form-anular" onsubmit="return confirm('¿Seguro que desea anular este trámite?');">
                                <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
                                <input type="hidden" name="accion" value="anular">
                                <input type="hidden" name="motivo_anulacion" value="Trámite anulado desde la bandeja de administración.">
                                <button type="submit" class="boton-anular">Anular</button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="8">No existen trámites registrados.</td>
            </tr>
        <?php } ?>
    </table>

    <br>

    <a class="boton" href="index.php">Nuevo trámite</a>
</div>

</body>
</html>