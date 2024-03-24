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

// Consulta SQL para obtener todos los datos de la tabla
$sql = "SELECT * FROM solicitudes";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Imprimir los datos en formato de tabla HTML
    echo "<table border='1'>";
    echo "<tr><th>Cliente</th><th>Email</th><th>Teléfono</th><th>Servicio</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["cliente"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["telefono"] . "</td>";
        echo "<td>" . $row["servicio"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron datos.";
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