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
        <!-- BUSQUEDA DE SOCIOS/MANTENIMIENTO -->
        <div>
            <h2>Lista de Socios</h2>
            <form class="form-inline" method="GET">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="num_doc" class="sr-only">Número de Documento:</label>
                    <input type="text" class="form-control" id="num_doc" name="num_doc"
                        placeholder="Número de Documento">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
            </form>
        </div>

        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Socio</th>
                        <th>Tipo de documento</th>
                        <th>Número de Documento</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('db.php');
                    $conexion = mysqli_connect("localhost", "root", "", "AccesRC");
                    $num_doc = isset($_GET['num_doc']) ? $_GET['num_doc'] : 'num_doc';

                    $query = "SELECT * FROM socios WHERE num_doc = '$num_doc'";
                    $result = mysqli_query($conexion, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $modalEditarId = "modalEditar_" . $row['id_socio'];
                            $modalEliminarId = "modalEliminar_" . $row['id_socio'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['id_socio'] ?>
                                </td>
                                <td>
                                    <?php echo $row['tip_doc'] ?>
                                </td>
                                <td>
                                    <?php echo $row['num_doc'] ?>
                                </td>
                                <td>
                                    <?php echo $row['nombre'] ?>
                                </td>
                                <td>
                                    <?php echo $row['apellido'] ?>
                                </td>
                                <td>
                                    <?php echo $row['direccion'] ?>
                                </td>
                                <td>
                                    <?php echo $row['correo'] ?>
                                </td>
                                <td>
                                    <?php echo $row['fecha'] ?>
                                </td>
                                <td class="actions">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#<?php echo $modalEditarId ?>">Editar</button>
                                    <button class="btn btn-danger"
                                        onclick="eliminarSocio(<?php echo $row["num_doc"]; ?>)">Eliminar</button>
                                </td>
                            </tr>

                            <!-- Modal de Edición -->
                            <div class="modal fade" id="<?php echo $modalEditarId ?>" tabindex="-1" role="dialog"
                                aria-labelledby="modalEditarLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditarLabel">Editar Socio - ID:
                                                <?php echo $row['id_socio'] ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Aquí puedes agregar los campos de edición del socio -->
                                            <!-- Por ejemplo, puedes usar un formulario con los campos necesarios -->
                                            <form method="POST" action="actualizar-tablaSocios.php">
                                                <div class="form-group">
                                                    <label for="num_doc">Numero de documento:</label>
                                                    <input type="text" class="form-control" id="num_doc" name="num_doc"
                                                        value="<?php echo $row['num_doc'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Nombre:</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                                        value="<?php echo $row['nombre'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="apellido">Apellido:</label>
                                                    <input type="text" class="form-control" id="apellido" name="apellido"
                                                        value="<?php echo $row['apellido'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="direccion">Direccion:</label>
                                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                                        value="<?php echo $row['direccion'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo :</label>
                                                    <input type="text" class="form-control" id="correo" name="correo"
                                                        value="<?php echo $row['correo'] ?>">
                                                </div>
                                                <input type="hidden" name="id_socio" id="id_socio"
                                                    value="<?php echo $row['id_socio'] ?>">
                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                <?php
                                                // if (!empty($_POST)) {
                                                //     $alert = '';
                                                //     $idSocio = $_POST['id_socio'];
                                                //     $name = $_POST['nombre'];
                                                //     $lastname = $_POST['apellido'];
                                                //     $location = $_POST['direccion'];
                                                //     $email = $_POST['correo'];
                                                //     $documentNumber = $_POST['num_doc'];
                                        
                                                //     if (empty($idSocio) || empty($name) || empty($lastname) || empty($documentNumber) || empty($email) || empty($location)) {
                                                //         $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
                                                //     } else {
                                                //         include('db.php');
                                        
                                                //         $query_insert = mysqli_query($conexion, "UPDATE Socios SET num_doc = '$documentNumber', nombre = '$name', apellido = '$lastname', direccion = '$location', correo = '$email' WHERE id_socio='$idSocio' ");
                                                //         if ($query_insert) {
                                                //                     $alert = '<p class="msg_save">Visitante registrado correctamente.</p>';
                                                //                 } else {
                                                //                     $alert = '<p class="msg_error">Error al registrar visitante.</p>';
                                                //                 }
                                        
                                                //     }
                                                // }
                                                ?>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal de Eliminación -->
                            <div class="modal fade" id="<?php echo $modalEliminarId ?>" tabindex="-1" role="dialog"
                                aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEliminarLabel">Eliminar Socio - ID:
                                                <?php echo $row['id_socio'] ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro de eliminar este socio?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="eliminar_socio.php">
                                                <input type="hidden" name="id_socio" value="<?php echo $row['id_socio'] ?>">
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="9">No se encontraron socios con el número de documento
                                <?php echo $num_doc ?>
                            </td>
                        </tr>
                        <?php
                    }
                    $conexion = mysqli_connect("localhost", "root", "", "AccesRC");
                    ?>
                </tbody>
            </table>
            <div class="msg_alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
        </div>
    </div>
    <script>
        function eliminarSocio(num_doc) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará el socio seleccionado. ¿Deseas continuar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redireccionar a la página de tabla de familiares con el num_doc del socio
                    window.location.href = "eliminar_socio.php?num_doc=" + num_doc;
                }
            });
        }
    </script>
</body>

</html>