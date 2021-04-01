<?php
// include database and object files
include ('../connection.php');
include ('../functions/functions.php');
// get database connection
$database = new Database();
$db = $database->getConnection();
$msg = '';

// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $db->prepare('SELECT * FROM empleados WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$empleado) {
        exit('No existe empleado con ese ID');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $db->prepare('DELETE FROM empleados WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Has borrado este registro';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('ID no especificada');
}
?>

<?=template_header_crud('Delete')?>

<div class="content delete">
    <h2>Borrar registro #<?=$empleado['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Estas seguro de borrar este registro #<?=$empleado['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$empleado['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$empleado['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>