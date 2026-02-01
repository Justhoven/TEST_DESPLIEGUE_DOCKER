<?php
$servername = "db";     // Cambiar si tu servidor MYSQL no está en localhost
$username = "usuario1";     // Nombre de usuario de MYSQL
$password = "contrasenyaUsuario1";  // Contraseña de MYSQL
$dbname = "cine";       // Nombre de la BD   

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "<h2>Conexión exitosa a la base de datos</h2>";

$sql = "SELECT * FROM peliculas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Título</th><th>Director</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["titulo"]."</td><td>".$row["director"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}

$conn->close();
?>
