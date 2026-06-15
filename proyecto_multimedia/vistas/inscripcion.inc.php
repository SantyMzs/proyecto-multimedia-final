<h2>Inscripción de Materias</h2>

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

    <label>Gestión académica:</label>
    <input type="text" name="gestion" placeholder="Ej: 2026" required>

    <label>Materia 1:</label>
    <input type="text" name="materia1" required>

    <label>Materia 2:</label>
    <input type="text" name="materia2">

    <label>Materia 3:</label>
    <input type="text" name="materia3">

    <button type="submit">Continuar</button>
</form>