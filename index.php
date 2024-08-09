<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('config.php');

// Crear (Create)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $edad = $_POST['edad'];
    $peliculasfa = $_POST['peliculasfa'];
    $génerospe = $_POST['génerospe'];

    $sql = "INSERT INTO actores (nombre, genero, edad, peliculasfa, génerospe) VALUES ('$nombre', '$genero', $edad, '$peliculasfa', '$génerospe')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Actor agregado correctamente.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Actualizar (Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $edad = $_POST['edad'];
    $peliculasfa = $_POST['peliculasfa'];
    $génerospe = $_POST['génerospe'];

    $sql = "UPDATE actores SET nombre='$nombre', genero='$genero', edad=$edad, peliculasfa='$peliculasfa', génerospe='$génerospe' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Actor actualizado correctamente.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Borrar (Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];

    $sql = "DELETE FROM actores WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Actor eliminado correctamente.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Leer (Read)
$sql = "SELECT id, nombre, genero, edad, peliculasfa, génerospe FROM actores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Actores</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Lista de Actores</h1>
        <form id="createForm" method="POST" action="index.php">
            <input type="hidden" name="action" value="create">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            <input type="text" name="genero" id="genero" placeholder="Género" required>
            <input type="number" name="edad" id="edad" placeholder="Edad" required>
            <input type="text" name="peliculasfa" id="peliculasfa" placeholder="Películas Favoritas" required>
            <input type="text" name="génerospe" id="génerospe" placeholder="Géneros Preferidos" required>
            <button type="submit">Agregar Actor</button>
        </form>

        <ul id="actorList">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo htmlspecialchars($row["nombre"]). " - " . htmlspecialchars($row["genero"]) . " - " . htmlspecialchars($row["edad"]) . " años - Películas Favoritas: " . htmlspecialchars($row["peliculasfa"]) . " - Géneros Preferidos: " . htmlspecialchars($row["génerospe"]);
                    echo ' <button class="editBtn" data-id="' . $row["id"] . '" data-nombre="' . htmlspecialchars($row["nombre"]) . '" data-genero="' . htmlspecialchars($row["genero"]) . '" data-edad="' . htmlspecialchars($row["edad"]) . '" data-peliculasfa="' . htmlspecialchars($row["peliculasfa"]) . '" data-génerospe="' . htmlspecialchars($row["génerospe"]) . '">Editar</button>';
                    echo ' <form class="deleteForm" method="POST" action="index.php" style="display:inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="' . $row["id"] . '">
                        <button type="submit">Eliminar</button>
                    </form>';
                    echo "</li>";
                }
            } else {
                echo "<p>No hay actores registrados.</p>";
            }
            ?>
        </ul>

        <div id="editFormContainer" style="display:none;">
            <h2>Editar Actor</h2>
            <form id="editForm" method="POST" action="index.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="editId">
                <input type="text" name="nombre" id="editNombre" placeholder="Nombre" required>
                <input type="text" name="genero" id="editGenero" placeholder="Género" required>
                <input type="number" name="edad" id="editEdad" placeholder="Edad" required>
                <input type="text" name="peliculasfa" id="editPeliculasfa" placeholder="Películas Favoritas" required>
                <input type="text" name="génerospe" id="editGénerospe" placeholder="Géneros Preferidos" required>
                <button type="submit">Actualizar Actor</button>
            </form>
        </div>
    </div>
</body>
</html>
