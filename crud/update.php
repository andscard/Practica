<?php
// include database and object files
include ('../connection.php');
include ('../functions/functions.php');
// get database connection
$database = new Database();
$db = $database->getConnection();
$msg = '';


/// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : '';
        $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
        $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        // Update the record
        $stmt = $db->prepare('UPDATE empleados SET id = ?, nombres = ?, apellidos = ?, departamento = ?, email = ? WHERE id = ?');
        $stmt->execute([$id, $nombres, $apellidos, $departamento, $email,  $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $db->prepare('SELECT * FROM empleados WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$empleado) {
        exit('No existe empleado con ese ID');
    }
} else {
    exit('ID no especificada');
}
?>

<?=template_header_crud('Read')?>

<div class="content update">
  <h2>Actualizar Empleado #<?=$empleado['id']?></h2>
    <form action="update.php?id=<?=$empleado['id']?>" method="post">
        <label for="id">ID</label>
        <label ></label>
        <input type="text" name="id" placeholder="00000000" value="<?=$empleado['id']?>" id="id">
        <label ></label>
        <label for="nombres">Nombres</label>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="nombres" placeholder="Name1 Name2" value="<?=$empleado['nombres']?>" id="nombres">
        <input type="text" name="apellidos" placeholder="John Doe"value="<?=$empleado['apellidos']?>" id="apellidos">
        <label for="email">Departamento</label>
        <label for="phone">Email</label>
        <input type="text" name="departamento" placeholder="Redes" value="<?=$empleado['departamento']?>" id="departamento">
        <input type="text" name="email" placeholder="empleado@example.com" value="<?=$empleado['email']?>" id="email">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>