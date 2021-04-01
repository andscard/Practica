
/*Sentencia SQL para crear la tabla empleados
se debe crear primero la DB "practica" */
CREATE TABLE IF NOT EXISTS `empleados` (
	`id` int(10) NOT NULL,
  	`nombres` varchar(100) NOT NULL,
  	`apellidos` varchar(100) NOT NULL,
  	`departamento` varchar(100) NOT NULL,
  	`email` varchar(100) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `empleados` (`id`, `nombres`, `apellidos`, `departamento`, `email`) VALUES
(0930564837, 'Andrea Sheyla', 'Cardenas Sumba', 'Desarrollo', 'acardenas@example.com'),
(0930564866, 'Angie Domenica', 'Molina Cabanilla', 'IoT', 'amolina@example.com');


CREATE TABLE IF NOT EXISTS `users` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL,
  	`password` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');
