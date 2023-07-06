<?php
if (!$_COOKIE["rol"]) {
    header("location:index.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidemenu.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" type="image/png" href="img/favicon.png">

    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<<body class="body-expanded">
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
    <div class="main-container">
        <div class="main-container__welcome">
            Bienvenido.
        </div>
        Rinconada Contry Club

    </div>

</body>
    <script>
        const btn = document.querySelector('#menu-btn');
        const menu = document.querySelector('#sidemenu');
        btn.addEventListener('click', e => {
            menu.classList.toggle("menu-expanded");
            menu.classList.toggle("menu-collapsed");

            document.querySelector('body').classList.toggle('body-expanded');
        });
    </script>
    <div class="main-container">
        <div class="main-container__welcome">
            Bienvenido.
        </div>
        Rinconada Contry Club

    </div>

</body>

</html>