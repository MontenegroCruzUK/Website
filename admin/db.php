<?php
// Definición de las credenciales de la base de datos
$server = "localhost"; // Dirección del servidor de la base de datos (puede ser una IP o "localhost")
$db_name = "db_website"; // Nombre de la base de datos a la que se desea conectar (sin espacios en el nombre)
$user = "root"; // Nombre de usuario de la base de datos (ajustar según tus configuraciones)
$password = ""; // Contraseña de la base de datos (ajustar según tus configuraciones, dejar vacío si no hay contraseña)

try {
    // Establecer la conexión a la base de datos utilizando PDO
    $connection = new PDO("mysql:host=$server;dbname=$db_name", $user, $password);
    echo "Conexion exitosa -> ";

    // Establecer el modo de errores para que PDO arroje excepciones en caso de errores
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cerrar la conexión
    $conn = null;
} catch (PDOException $e) {
    // En caso de un error en la conexión, se captura la excepción y se muestra un mensaje
    $errorMessage = "Error de conexión: " . $e->getMessage();
    echo $errorMessage . PHP_EOL;
    die($errorMessage);
}