<?php

echo "Consulta SQL: " . $sql;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Conexión a la base de datos
$servidorDb = "localhost";
$usuarioDb = "root";
$contrasenaDb = "1023974256";
$nombreDb = "gpamotors";

$conn = new mysqli($servidorDb, $usuarioDb, $contrasenaDb, $nombreDb);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
        // Captura los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $tipoDocumento = $_POST["tipoDocumento"];
        $documento = $_POST["documento"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];
        $genero = $_POST["genero"];
        $correo = $_POST["email"];
        $contrasena = $_POST["contrasena"];
        $confirmarContrasena = $_POST["contrasena"];

        if (strcmp($contrasena, $confirmarContrasena) !== 0) {
            echo "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
            return false;
        }
        
        // Encriptar la contraseña utilizando password_hash
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Prepara una consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO usuarios (usuNombre, usuApellido, usuTipoDocumento, usuDocumento, usuTelefono, usuDireccion, usuGenero, usuCorreo, usuContrasena) VALUES ('$nombres', '$apellidos', '$tipoDocumento', '$documento', '$telefono', '$direccion', '$genero', '$correo', '$hashed_password')";
        

        // Ejecuta la consulta
        if ($conn->query($sql) === TRUE) {
            echo "Datos almacenados correctamente";
            header("Location: ../login.html");
            exit();
        } else {
            echo "Error al almacenar datos: " . $conn->error;
        }
    
        // Cierra la conexión a la base de datos
        $conn->close();
    }
    

?>
