<h2>Documentos requeridos</h2>

<form method="POST" action="motor.php">
    <input type="hidden" name="id" value="<?php echo $tramite['id']; ?>">
    <input type="hidden" name="accion" value="guardar_documentos">

    <p>Seleccione los documentos que presenta:</p>

    <label>
        <input type="checkbox" name="documentos[]" value="Fotocopia de CI">
        Fotocopia de Cédula de Identidad
    </label>

    <label>
        <input type="checkbox" name="documentos[]" value="Matrícula universitaria">
        Matrícula universitaria
    </label>

    <label>
        <input type="checkbox" name="documentos[]" value="Historial académico">
        Historial académico
    </label>

    <label>
        <input type="checkbox" name="documentos[]" value="Comprobante de pago">
        Comprobante de pago
    </label>

    <button type="submit">Enviar a revisión</button>
</form>