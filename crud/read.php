<?php

include ('../functions/functions.php');
include ('../connection.php');

//Conexion a la base de datos
$database = new Database();
$db = $database->getConnection();

// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;

//Preparar la sentencia SQL
$stmt = $db->prepare('SELECT * FROM empleados ORDER BY id ');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_empleados = $db->query('SELECT COUNT(*) FROM empleados')->fetchColumn();
?>


<?=template_header_crud('Read')?>

<div class="content read">

    <h2>Lista de Empleados</h2>
    <a href="create.php" class="create-contact">Registrar Empleado</a>
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nombres</td>
                <td>Apellidos</td>
                <td>Departamento</td>
                <td>Correo</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado): ?>
            <tr>
                <td><?=$empleado['id']?></td>
                <td><?=$empleado['nombres']?></td>
                <td><?=$empleado['apellidos']?></td>
                <td><?=$empleado['departamento']?></td>
                <td><?=$empleado['email']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$empleado['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$empleado['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page*$records_per_page < $num_empleados): ?>
        <a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>
?> 