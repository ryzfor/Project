
<?php

include('db.php');

$USUARIO=$_POST['usuario'];
$PASSWORD=$_POST['password'];

$consulta = "SELECT * FROM UsuariosLogin where username_id = '$USUARIO' and password = '$PASSWORD' ";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado);
$row = mysqli_fetch_array($resultado);

if($filas){
    setcookie("rol", $row['rol_roles'], time()+3600, "/");
    header("location:home.php");
}else{
    include("index.html");
    ?>
    <script>
        //alert("Usuario");
        document.getElementById("errorcontent").innerHTML = "<?php echo '<p>Usuario o Contraseña incorrecta</p>'; ?>";
    </script>
    <?php
    //header("location:index.html");
}
mysqli_free_result($resultado);
mysqli_close($conexion);

?>

