<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_faml_socio = $_GET['id_faml_socio'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $num_doc_familiar = $_POST['num_doc'];
    $parentesco = $_POST['parentesco'];
    include('db.php');
    $conexion = mysqli_connect("localhost", "root", "", "AccesRC");

    // Consulta para obtener el num_doc del socio asociado al familiar
    $sql_num_doc_socio = "SELECT num_doc FROM socios WHERE id_socio IN (SELECT id_socio FROM familiares WHERE id_faml_socio = '$id_faml_socio')";
    $result_num_doc_socio = mysqli_query($conexion, $sql_num_doc_socio);
    $row_num_doc_socio = mysqli_fetch_assoc($result_num_doc_socio);
    $num_doc_socio = $row_num_doc_socio['num_doc'];

        // Check if the updated DNI is already registered for another familiar
        $sql_check_dni = "SELECT id_faml_socio FROM familiares WHERE num_doc = '$num_doc_familiar' AND id_faml_socio != '$id_faml_socio'";
        $result_check_dni = mysqli_query($conexion, $sql_check_dni);

        if (mysqli_num_rows($result_check_dni) > 0) {
            // DNI is already registered for another familiar
            $alert_message = "El número de DNI ya está registrado para otro familiar.";

            header("Location: mant-tabla-famili.php?num_doc=$num_doc_socio"."&error=409");
            exit();
        }else
        {
                // Handle the error in case of update failure
                $alert_message = "Error al actualizar los datos del familiar. Por favor, intenta nuevamente.";
        }
    
    // Update the familiar's data
    $sql = "UPDATE familiares 
            SET nombre='$nombre', apellido='$apellido', num_doc='$num_doc_familiar', parentesco='$parentesco' 
            WHERE id_faml_socio='$id_faml_socio' AND id_socio IN (SELECT id_socio FROM socios WHERE num_doc = '$num_doc_socio')";
    $result_familiares = mysqli_query($conexion, $sql);

    if ($result_familiares) {
        // Redirect to the main page with the num_doc of the socio
        header("Location: mant-tabla-famili.php?num_doc=$num_doc_socio"."&rpt=update");
        exit();
        
    } else {
        // Handle the error in case of update failure
        $alert_message = "Error al actualizar los datos del familiar. Por favor, intenta nuevamente.";
    }
}
?>