<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de MySQL no está en localhost
$username = "root"; // Cambia esto por tu nombre de usuario de MySQL
$password = "bd2024+"; // Cambia esto por tu contraseña de MySQL
$database = "formulario_db"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario de manera segura para evitar inyecciones SQL
$cliente = mysqli_real_escape_string($conn, $_POST['cliente']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
$servicio = mysqli_real_escape_string($conn, $_POST['servicio']);

// Preparar la consulta SQL para insertar los datos en la base de datos
$sql = "INSERT INTO solicitudes (cliente, email, telefono, servicio) VALUES ('$cliente', '$email', '$telefono', '$servicio')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Datos guardados correctamente en la base de datos.";

    // Realizar una consulta para obtener los datos guardados
    $consulta = "SELECT * FROM solicitudes WHERE cliente='$cliente' AND email='$email' AND telefono='$telefono' AND servicio='$servicio'";
    $resultado = $conn->query($consulta);

    // Mostrar los datos guardados
    if ($resultado->num_rows > 0) {
        echo "<br><br>";
        echo "Datos guardados:<br>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "Cliente: " . $fila["cliente"] . "<br>";
            echo "Email: " . $fila["email"] . "<br>";
            echo "Teléfono: " . $fila["telefono"] . "<br>";
            echo "Servicio: " . $fila["servicio"] . "<br>";
        }
    } else {
        echo "No se encontraron datos.";
    }
} else {
    $error_message = "Error al guardar los datos: " . $conn->error;
    echo $error_message;
    // Redirigir el error a un archivo de registro
    error_log($error_message, 3, "error_log.txt");
}

// Cerrar la conexión
$conn->close();

// Mostrar el botón de cancelar
echo '<button onclick="cancelar()">Cancelar</button>';
?>
<script>
function cancelar() {
    window.history.back();
}
</script>