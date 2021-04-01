<?php

//Esta funcion, se coloca en el header, establece un formato general para cambiar entre paginas
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="./css/menu.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Registro de Empleados</h1>
            <a href="home.php"><i class="fas fa-home"></i>Home</a>
    		<a href="./crud/read.php">Ver</a>
    	</div>
    </nav>
EOT;
}


function template_header_crud($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>$title</title>
        <link href="../css/menu.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
    <nav class="navtop">
        <div>
            <h1>Registro de Empleados</h1>
            <a href="/practicacrud/home.php"><i class="fas fa-home"></i>Home</a>
            <a href="../crud/read.php">Ver</a>
        </div>
    </nav>
EOT;
}

function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>