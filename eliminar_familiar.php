<?php
include('db.php');
$conexion = mysqli_connect("localhost", "root", "", "AccesRC");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_faml_socio = $_GET['id_faml_socio'];
    $num_doc = $_GET['num_doc'];

    // Obtener el id_socio utilizando el num_doc
    $sql_id_socio = "SELECT id_socio FROM socios WHERE num_doc = '$num_doc'";
    $result_id_socio = mysqli_query($conexion, $sql_id_socio);
    $row_id_socio = mysqli_fetch_assoc($result_id_socio);
    $id_socio = $row_id_socio['id_socio'];

    // Realizar la eliminación del familiar
    $sql_eliminar = "DELETE FROM familiares WHERE id_faml_socio = '$id_faml_socio'";
    $result_eliminar = mysqli_query($conexion, $sql_eliminar);

    if ($result_eliminar) {
        // Redireccionar a la página de tabla de familiares con el num_doc del socio
        header("Location: mant-tabla-famili.php?num_doc=$num_doc"."&rpt=delete");
        exit();
    } else {
        // Manejar el error en caso de fallo en la eliminación
        echo "Error al eliminar el familiar. Por favor, intenta nuevamente.";
    }
}
?>