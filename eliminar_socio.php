<?php
include('db.php');
$conexion = mysqli_connect("localhost", "root", "", "AccesRC");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $num_doc = $_GET['num_doc'];

    // Realizar la eliminación del familiar
    $sql_eliminar = "DELETE FROM socios WHERE num_doc = '$num_doc'";
    $result_eliminar = mysqli_query($conexion, $sql_eliminar);

    if ($result_eliminar) {
        // Redireccionar a la página de tabla de socios con el num_doc del socio
        header("Location: mant-tablaSocios.php?num_doc=$num_doc"."&rpt=delete");
        exit();
    } else {
        // Manejar el error en caso de fallo en la eliminación
        echo "Error al eliminar el socio. Por favor, intenta nuevamente.";
    }
}
?>