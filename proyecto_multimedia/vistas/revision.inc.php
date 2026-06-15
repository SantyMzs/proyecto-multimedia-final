<h2>Revisión del trámite</h2>

<?php
$datos = isset($tramite["datos"]) ? $tramite["datos"] : [];
$documentos = isset($tramite["documentos"]) ? $tramite["documentos"] : [];

if (is_string($datos)) {
    $datos = json_decode($datos, true);
}

if (is_string($documentos)) {
    $documentos = json_decode($documentos, true);
}

if (!is_array($datos)) {
    $datos = [];
}

if (!is_array($documentos)) {
    $documentos = [];
}
?>

<h3>Datos registrados</h3>
<ul>
    <?php if (count($datos) > 0) { ?>
        <?php foreach ($datos as $clave => $valor) { ?>
            <li>
                <strong><?php echo ucfirst($clave); ?>:</strong>
                <?php
                if (is_array($valor)) {
                    echo implode(", ", $valor);
                } else {
                    echo $valor;
                }
                ?>
            </li>
        <?php } ?>
    <?php } else { ?>
        <li>No hay datos registrados.</li>
    <?php } ?>
</ul>

<h3>Documentos presentados</h3>
<ul>
    <?php if (count($documentos) > 0) { ?>
        <?php foreach ($documentos as $doc) { ?>
            <li><?php echo $doc; ?></li>
        <?php } ?>
    <?php } else { ?>
        <li>No se registraron documentos.</li>
    <?php } ?>
</ul>

<form method="POST" action="motor.php">
    <input type="hidden" name="id" value="<?php echo $tramite['id']; ?>">

    <label>Observación en caso de rechazo:</label>
    <textarea name="observacion" placeholder="Escriba una observación si va a rechazar el trámite"></textarea>

    <button type="submit" name="accion" value="aprobar">Aprobar trámite</button>
    <button type="submit" name="accion" value="rechazar" class="rojo">Rechazar trámite</button>
</form>