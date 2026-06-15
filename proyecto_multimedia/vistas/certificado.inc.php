<h2>Solicitud de Certificado de Notas</h2>

<form method="POST" action="motor.php">
    <input type="hidden" name="id" value="<?php echo $tramite['id']; ?>">
    <input type="hidden" name="accion" value="guardar_datos">

    <label>Nombre completo:</label>
    <input type="text" name="nombre" required>

    <label>Cédula de identidad:</label>
    <input type="text" name="ci" required>

    <label>Carrera:</label>
    <input type="text" name="carrera" required>

    <label>Correo electrónico:</label>
    <input type="email" name="correo" required>

    <label>Semestre cursado:</label>
    <input type="text" name="semestre" required>

    <label>Motivo de la solicitud:</label>
    <textarea name="motivo" required></textarea>

    <button type="submit">Continuar</button>
</form>