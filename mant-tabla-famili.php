<?php
if (!$_COOKIE["rol"]) {
    header("location:index.html");
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidemenu.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" type="image/png" href="img/favicon.png">

    <title>Registro de visitas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    
</head>

<body class="body-expanded">

    <div id="sidemenu" class="menu-expanded">

        <!--ENCABEZADO / HEADER-->
        <div id="header">
            <div id="title"><span>RCC GESTOR</span></div>
            <div id="menu-btn">
                <div class="btn-hamburguer"></div>
                <div class="btn-hamburguer"></div>
                <div class="btn-hamburguer"></div>
            </div>
        </div>

        <!--PROFILE / PERFIL-->
        <div id="profile">
            <div id="photo"><img class="foto_seguridad" src="img/security_photo.jpg" alt="foto de seguridad"></div>

            <div id="nameProfile"><span>Marcos Rivas</span></div>

        </div>

        <!--ITEMS / LISTA-->

        <div id="menu-items">
            <div class="item">
                <a href="register-partners.php">
                    <div class="icon"><img class="icon_visitas" src="img/registro_visitas_icon.png"
                            alt="icono de visitas"></div>
                    <div class="title">Registro de Socios</div>
                </a>
            </div>
            <div class="item">
                <a href="register-visit.php">
                    <div class="icon"><img class="icon_visitas" src="img/registro_visitas_icon.png"
                            alt="icono de visitas"></div>
                    <div class="title">Registro de Visitas</div>
                </a>
            </div>
            <div class="item">
                <a href="record-family.php">
                    <div class="icon"><img class="icon_visitas" src="img/mantenedor_familiar_icon.png"
                            alt="icono de visitas"></div>
                    <div class="title">Registro de Familiares</div>
                </a>
            </div>
            <?php
            if ($_COOKIE["rol"] != "2") {
                echo '<div class="item">
                    <a href="access-control.php">
                        <div class="icon"><img class="icon_visitas" src="img/control_acceso_icon.png" alt="icono de visitas"></div>
                        <div class="title">Control de Accesos</div>
                    </a>
                </div>';
            }
            ?>
            <div class="item">
                <a href="mant-tablaSocios.php">
                    <div class="icon"><img class="icon_visitas" src="img/mantenedor_socio_icon.png"
                            alt="icono de visitas"></div>
                    <div class="title">Mant. Tabla de Socios</div>
                </a>
            </div>
            <!--item 4-->
            <div class="item">
                <a href="mant-tabla-famili.php">
                    <div class="icon"><img class="icon_visitas" src="img/mantenedor_familiar_icon.png"
                            alt="icono de visitas"></div>
                    <div class="title">Mant. Tabla de Familiares</div>
                </a>
            </div>
        </div>
    </div>

    <script>
        const btn = document.querySelector('#menu-btn');
        const menu = document.querySelector('#sidemenu');
        btn.addEventListener('click', e => {
            menu.classList.toggle("menu-expanded");
            menu.classList.toggle("menu-collapsed");

            document.querySelector('body').classList.toggle('body-expanded');
        });
    </script>

<div class="container">
    <!-- BUSQUEDA DE SOCIOS -->
    <div>
        <h2>Ingresar DNI del Socio</h2>

        <form method="GET">
            <div class="form-group">
            <input type="text" class="form-control" name="num_doc">
            </div>
            <button type="submit" class="btn btn-default">Buscar Familiares</button>
        </form>

        <?php
        include('db.php');
        $conexion = mysqli_connect("localhost", "root", "", "AccesRC");


        if (isset($_GET['num_doc'])) {
            $num_doc = $_GET['num_doc'];
        
            $sql_socio = "SELECT * FROM socios WHERE num_doc = '$num_doc'";
            $result_socio = mysqli_query($conexion, $sql_socio);
        
            if (mysqli_num_rows($result_socio) > 0) {
                $row_socio = mysqli_fetch_assoc($result_socio);
        
                // Mostrar los datos del socio
                echo '<h2>Datos del Socio</h2>';
                echo '<div class="table-responsive">';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Nombre</th>';
                echo '<th>Apellido</th>';
                echo '<th>#Socio</th>';
                echo '<th>DNI</th>';
                echo '<th>Fecha de registro</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tr>';
                echo '<td>' . $row_socio['nombre'] . '</td>';
                echo '<td>' . $row_socio['apellido'] . '</td>';
                echo '<td>' . $row_socio['id_socio'] . '</td>';
                echo '<td>' . $row_socio['num_doc'] . '</td>';
                echo '<td>' . $row_socio['fecha'] . '</td>';
                echo '</tr>';
                echo '</table>';

                // Obtener los familiares del socio
                $sql_familiares = "SELECT * FROM familiares WHERE id_socio IN (SELECT id_socio FROM socios WHERE num_doc = '$num_doc')";
        $result_familiares = mysqli_query($conexion, $sql_familiares);


        if (mysqli_num_rows($result_familiares) > 0) {
            // Mostrar los datos de los familiares
            echo '<h2>Datos de los Familiares</h2>';
            echo '<div class="table-responsive">';
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Nombre</th>';
            echo '<th>Apellido</th>';
            echo '<th>DNI</th>';
            echo '<th>PARENTESCO</th>';
            echo '</tr>';
            echo '</thead>';

            while ($row_familiar = mysqli_fetch_assoc($result_familiares)) {
                // Mostrar los datos de cada familiar
                echo '<tr>';
                echo '<td>' . $row_familiar['nombre'] . '</td>';
                echo '<td>' . $row_familiar['apellido'] . '</td>';
                echo '<td>' . $row_familiar['num_doc'] . '</td>';
                echo '<td>' . $row_familiar['parentesco'] . '</td>';
                echo '<td>';
                echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modalEditarFamiliar' . $row_familiar['id_faml_socio'] . '">Editar</button>';
                echo '</td>';
                // Add delete button
                echo '<td>';
                echo '<button class="btn btn-danger" onclick="eliminarFamiliar(' . $row_familiar['id_faml_socio'] . ', \'' . $row_socio['num_doc'] . '\')">Eliminar</button>';
                echo '</td>';
                echo '</tr>';

                // Modal de edición para cada familiar
                echo '<div class="modal fade" id="modalEditarFamiliar' . $row_familiar['id_faml_socio'] . '" tabindex="-1" role="dialog" aria-labelledby="modalEditarFamiliarLabel' . $row_familiar['id_faml_socio'] . '" aria-hidden="true">';
                echo '<div class="modal-dialog" role="document">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="modalEditarFamiliarLabel' . $row_familiar['id_faml_socio'] . '">Editar Familiar</h5>';
                echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<form method="POST" action="actualizarFamiliar.php?id_faml_socio=' . $row_familiar['id_faml_socio'] . '">';
                echo '<div class="form-group">';
                echo '<label>Nombre:</label>';
                echo '<input type="text" class="form-control" name="nombre" value="' . $row_familiar['nombre'] . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label>Apellido:</label>';
                echo '<input type="text" class="form-control" name="apellido" value="' . $row_familiar['apellido'] . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label>DNI:</label>';
                echo '<input type="text" class="form-control" name="num_doc" value="' . $row_familiar['num_doc'] . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label>DNI:</label>';
                echo '<input type="text" class="form-control" name="parentesco" value="' . $row_familiar['parentesco'] . '">';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Actualizar</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                
            }
                    echo '</table>';
                } else {
                    echo '<p>No se encontraron familiares registrados para este socio.</p>';
                }
            } else {
                echo '<p>No se encontró un socio con el ID especificado.</p>';
            }
        }
    
        ?>

    </div>
</div>

<?php
if (isset($_GET["rpt"]) && $_GET["rpt"] == 'update') {
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: "Los datos del familiar se han actualizado correctamente.",
            showConfirmButton: true,
            allowOutsideClick: false
        }).then(() => {
            // Redireccionar a mant-tabla-famili.php con el num_doc del socio
            window.location.href = "mant-tabla-famili.php?num_doc=' . $_GET["num_doc"] . '";
        });
    </script>';
}

if (isset($_GET["error"]) && $_GET["error"] == '409') {
    echo '<script>
    Swal.fire({
        icon: "warning",
        title: "¡DNI existe!",
        text: "El número de DNI ya está registrado para otro familiar.",
        showConfirmButton: true,
        allowOutsideClick: false
    }).then(() => {
        // Redireccionar a mant-tabla-famili.php con el num_doc del socio
        window.location.href = "mant-tabla-famili.php?num_doc=' . $_GET["num_doc"] . '";
    });
</script>';
}
if (isset($_GET["rpt"]) && $_GET["rpt"] == 'delete') {
    echo '<script>
    Swal.fire({
        icon: "success",
        title: "¡Éxito!",
        text: "Los datos del familiar se han eliminado correctamente.",
        showConfirmButton: true,
        allowOutsideClick: false
    }).then(() => {
        // Redireccionar a mant-tabla-famili.php con el num_doc del socio
        window.location.href = "mant-tabla-famili.php?num_doc=' . $_GET["num_doc"] . '";
    });
</script>';
}
?>

<script>
function eliminarFamiliar(idFamiliar, numDoc) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción eliminará el familiar seleccionado. ¿Deseas continuar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redireccionar a la página de tabla de familiares con el num_doc del socio
            window.location.href = "eliminar_familiar.php?num_doc=" + numDoc+ "&id_faml_socio="+ idFamiliar;
        }
    });
}
</script>

</body>

</html>