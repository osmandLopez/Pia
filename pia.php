<?php
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "nombre_de_tu_base_de_datos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<?php
// Crear una nueva nota
function createNota($titulo, $contenido)
{
    global $conn;
    $sql = "INSERT INTO notas (titulo, contenido, fecha_creacion) VALUES ('$titulo', '$contenido', NOW())";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error al crear la nota: " . $conn->error);
    }
}

// Obtener todas las notas
function getNotas()
{
    global $conn;
    $sql = "SELECT * FROM notas";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error al obtener las notas: " . $conn->error);
    }
    $notas = array();
    while ($row = $result->fetch_assoc()) {
        $notas[] = $row;
    }
    return $notas;
}

// Obtener una nota por su ID
function getNotaById($id)
{
    global $conn;
    $sql = "SELECT * FROM notas WHERE id = $id";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error al obtener la nota: " . $conn->error);
    }
    $nota = $result->fetch_assoc();
    return $nota;
}
    
// Actualizar una nota existente
function updateNota($id, $titulo, $contenido)
{
    global $conn;
    $sql = "UPDATE notas SET titulo = '$titulo', contenido = '$contenido' WHERE id = $id";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error al actualizar la nota: " . $conn->error);
    }
}

// Eliminar una nota
function deleteNota($id)
{
    global $conn;