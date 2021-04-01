<?php
 
include ('../connection.php');
include ('../functions/functions.php');
//Conexion a la base de datos
$database = new Database();
$db = $database->getConnection();
 

$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Verificar si los campos están vacios, en caso de que no se llene se lo deja en blanco
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : '';
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
    $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
       
    // Insetar el nuevo registro en la tabla de empleados
    $stmt = $db->prepare('INSERT INTO empleados VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nombres, $apellidos, $departamento, $email]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header_crud('Create')?>

<div class="content update">
    <h2>Añadir Empleado</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label ></label>
        <input type="text" name="id" placeholder="0000000000"  id="id">
        <label ></label>
        <label for="nombres">Nombres</label>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="nombres" placeholder="Aaaa Bbbb" id="nombres">
        <input type="text" name="apellidos" placeholder="Cccc Dddd" id="apellidos">
        <label for="departamento">Departamento</label>
        <label for="email">Email</label>
        <input type="text" name="departamento" placeholder="IoT" id="departamento">
        <input type="text" name="email" placeholder="johndoe@example.com" id="email">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>