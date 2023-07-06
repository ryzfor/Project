<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_socio = $_POST['id_socio'];
    $num_doc_socio = $_POST['num_doc'];
    $nuevo_nombre = $_POST['nombre'];
    $nuevo_apellido = $_POST['apellido'];
    $nueva_direccion = $_POST['direccion'];
    $nuevo_correo = $_POST['correo'];
    include('db.php');
    $conexion = mysqli_connect("localhost", "root", "", "AccesRC");

    // Realizar la consulta para actualizar los datos del socio
    $consulta_actualizar = "UPDATE socios SET num_doc = '$num_doc_socio', nombre = '$nuevo_nombre', apellido = '$nuevo_apellido', direccion = '$nueva_direccion', correo = '$nuevo_correo' WHERE id_socio='$id_socio'";
    $result_socios = mysqli_query($conexion, $consulta_actualizar);


    if ($result_socios) {
        // Redirect to the main page with the num_doc of the socio
        header("Location: mant-tablaSocios.php?num_doc=$num_doc_socio"."&rpt=update");
        exit();
        
    } else {
        // Handle the error in case of update failure
        $alert_message = "Error al actualizar los datos del Socio. Por favor, intenta nuevamente.";
    }
    
  }
?>

