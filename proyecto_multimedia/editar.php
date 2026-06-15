<?php
include "includes/funciones.php";

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$tramite = obtenerTramitePorID($id);

if (!$tramite) {
    die("Trámite no encontrado.");
}

$datos = isset($tramite["datos"]) && is_array($tramite["datos"]) ? $tramite["datos"] : [];
$tipo = $tramite["tipo"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Trámite</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Editar Trámite</h1>

    <div class="estado <?php echo claseEstado($tramite["estado"]); ?>">
        <strong>ID:</strong> <?php echo $tramite["id"]; ?> |
        <strong>Tipo:</strong> <?php echo obtenerNombreTramite($tipo); ?> |
        <strong>Estado actual:</strong> <?php echo strtoupper($tramite["estado"]); ?>
    </div>

    <form method="POST" action="motor.php">
        <input type="hidden" name="id" value="<?php echo $tramite['id']; ?>">
        <input type="hidden" name="accion" value="actualizar_datos">

        <label>Nombre completo:</label>
        <input type="text" name="nombre" value="<?php echo $tramite['nombre']; ?>" required>

        <label>Cédula de identidad:</label>
        <input type="text" name="ci" value="<?php echo $tramite['ci']; ?>" required>

        <label>Carrera:</label>
        <input type="text" name="carrera" value="<?php echo $tramite['carrera']; ?>" required>

        <label>Correo electrónico:</label>
        <input type="email" name="correo" value="<?php echo $tramite['correo']; ?>" required>

        <?php if ($tipo === "certificado") { ?>

            <label>Semestre cursado:</label>
            <input type="text" name="semestre" value="<?php echo valorDato($datos, 'semestre'); ?>" required>

            <label>Motivo de la solicitud:</label>
            <textarea name="motivo" required><?php echo valorDato($datos, 'motivo'); ?></textarea>

        <?php } ?>

        <?php if ($tipo === "inscripcion") { ?>

            <label>Gestión académica:</label>
            <input type="text" name="gestion" value="<?php echo valorDato($datos, 'gestion'); ?>" required>

            <label>Materia 1:</label>
            <input type="text" name="materia1" value="<?php echo valorDato($datos, 'materia1'); ?>" required>

            <label>Materia 2:</label>
            <input type="text" name="materia2" value="<?php echo valorDato($datos, 'materia2'); ?>">

            <label>Materia 3:</label>
            <input type="text" name="materia3" value="<?php echo valorDato($datos, 'materia3'); ?>">

        <?php } ?>

        <label>Motivo de la edición:</label>
        <textarea name="motivo_edicion" placeholder="Ej: Se corrigió el nombre debido a una equivocación del estudiante o se cambió la materia solicitada." required></textarea>

        <button type="submit">Guardar cambios</button>
    </form>

    <br>

    <a href="tramite.php?id=<?php echo $tramite['id']; ?>">Volver al trámite</a> |
    <a href="bandeja.php">Volver a bandeja</a>
</div>

</body>
</html>