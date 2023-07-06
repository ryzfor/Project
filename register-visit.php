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
        <!--BUSQUEDA DE SOCIOS-->
        <div>
            <h2>Ingresar Código del Socio</h2>
            <form class="form-inline" method="GET">
                <div class="form-group">
                    <label>Código:</label>
                    <input type="text" class="form-control" id="code" placeholder="Ingrese socio" name="code">
                </div>

                <button type="submit" class="btn btn-default">Buscar</button>

            </form>

            <table class="table">
                <h2>Resultados de la búsqueda</h2>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>#Socio</th>
                        <th>DNI</th>
                        <th>Correo</th>
                        <th>Fecha de registro</th>
                    </tr>
                </thead>
                <?php
                include('db.php');
                $conexion = mysqli_connect("localhost", "root", "", "AccesRC");
                $code = isset($_GET['code']) ? $_GET['code'] : [];
                if (empty($code)) {
                    return;
                }
                $sql = "SELECT * from socios WHERE num_doc LIKE '%$code%' ";
                $result = mysqli_query($conexion, $sql);
                while ($row = mysqli_fetch_array($result)) {

                    ?>


                    <tr>
                        <td>
                            <?php echo $row['nombre'] ?>
                        </td>
                        <td>
                            <?php echo $row['apellido'] ?>
                        </td>
                        <td>
                            <?php echo $row['id_socio'] ?>
                        </td>
                        <td>
                            <?php echo $row['num_doc'] ?>
                        </td>
                        <td>
                            <?php echo $row['correo'] ?>
                        </td>
                        <td>
                            <?php echo $row['fecha'] ?>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </table>
        </div>

        <div>
            <table width="40%" height="70">
                <tr>
                    <td><label for="checkInvited">¿Es un invitado?</label></td>
                    <td><input type="checkbox" id="checkInvited" name="checkInvited"></td>
                </tr>
                <tr>
                    <td><label for="numberInvited">Cantidad de Socios:</label></td>
                    <td><input type="number" class="form-control" id="numberInvited" name="numberInvited"></td>
                </tr>
            </table>
        </div>

        <div id="container_invited">
            <h2>Ingresar datos del Invitado</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="number" min="8" max="120" class="form-control" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="dni">DNI:</label>
                    <input type="text" maxlength="8" class="form-control" id="documentNumber" name="documentNumber"
                        required>
                </div>
                <div class="form-group">
                    <label for="codesocio">Código de socio:</label>
                    <input type="text" maxlength="8" class="form-control" id="codesocio" name="codesocio" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" maxlength="30" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" maxlength="40" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-group">
                    <label for="fecha_hora">Fecha y Hora:</label>
                    <input type="datetime-local" class="form-control" id="date" name="date" required>
                </div>

                <div class="form-group" id="div_socios">

                </div>
                <button type="submit" id="register_visited" class="btn btn-primary">Registrar Visita</button>

                <?php
                if (!empty($_POST)) {
                    $alert = '';

                    $name = $_POST['name'];
                    $lastname = $_POST['lastname'];
                    $age = $_POST['age'];
                    $documentNumber = $_POST['documentNumber'];
                    $email = $_POST['email'];
                    $location = $_POST['location'];
                    $date = $_POST['date'];
                    $code = $_POST['codesocio'];

                    if (empty($name) || empty($lastname) || empty($age) || empty($documentNumber) || empty($email) || empty($location) || empty($date)) {
                        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
                    } else {
                        include('db.php');

                        $existPartner = mysqli_query($conexion, "SELECT * from socios WHERE num_doc = '$documentNumber'");
                        $result = mysqli_fetch_array($existPartner);

                        if (empty($result)) {
                            $query_insert = mysqli_query($conexion, "INSERT INTO visita(tip_doc, num_doc, nombre, apellido, id_socio) 
                                                                        VALUES('D01', '$documentNumber', '$name', '$lastname', '$code')");
                            if ($query_insert) {
                                $alert = '<p class="msg_save">Visitante registrado correctamente.</p>';
                            } else {
                                $alert = '<p class="msg_error">Error al registrar visitante.</p>';
                            }
                        } else {
                            $alert = '<p class="msg_error">El visitante ya existe registrado.</p>';
                        }
                    }
                }
                ?>

            </form>
        </div>

        <div class="msg_alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>

        <script>

            var checkInvited = document.getElementById('checkInvited');
            var register_visited = document.getElementById('register_visited');
            var containerInvited = document.getElementById('container_invited');
            const divSocios = document.querySelector('#div_socios');
            const cantidadSocios = document.querySelector('#numberInvited');

            containerInvited.style.display = 'none'
            cantidadSocios.disabled = true;

            checkInvited.addEventListener('click', function () {
                if (checkInvited.checked) {
                    containerInvited.style.display = 'block';
                    cantidadSocios.disabled = false;
                } else {
                    containerInvited.style.display = 'none'
                    cantidadSocios.disabled = true;
                }
            });

            register_visited.addEventListener('click', function () {
                containerInvited.style.display = 'block';
            });

            cantidadSocios.addEventListener('input', () => {
                divSocios.innerHTML = '';
                const nSocios = parseInt(cantidadSocios.value) + 1;
                if (nSocios > 0) {
                    for (let i = 0; i < nSocios - 1; i++) {
                        const html = `
                            <div style="background: #f0ffe4"><h4>Visita ${i + 2}</h4></div>
                            
                            <div class="form-group">
                                <label for="name_${i + 2}">Nombres:</label>
                                <input type="text" class="form-control" id="name_" name="name_" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname_${i + 2}">Apellidos:</label>
                                <input type="text" class="form-control" id="lastname_" name="lastname_" required>
                            </div>
                            <div class="form-group">
                                <label for="age_${i + 2}">Edad:</label>
                                <input type="number" max="3" class="form-control" id="age_" name="age_" required>
                            </div>
                            <div class="form-group">
                                <label for="docNumber_${i + 2}">DNI:</label>
                                <input type="number" min="8" max="8" class="form-control" id="docNumber_" name="docNumber_" required>
                            </div>
                        `;
                        divSocios.insertAdjacentHTML('beforeend', html);
                    }
                }
            });
        </script>
    </div>

</body>

</html>