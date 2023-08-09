<?php
require 'database.php';
$message = '';
if (!empty($_POST['email']) && !empty($_POST['password']) && 
!empty($_POST['nombres']) && !empty($_POST['apellidos'])) {
$sql = "INSERT INTO users (nombres, apellidos, email, password) VALUES
(:nombres, :apellidos, :email, :password)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nombres', $_POST['nombres']);
$stmt->bindParam(':apellidos', $_POST['apellidos']);
$stmt->bindParam(':email', $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$stmt->bindParam(':password', $password);
if ($stmt->execute()) {
$message = 'El usuario fue creado exitosamente';
} else {
$message = 'Lo sentimos! pero hubo un problema al crear su cuenta';
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SignUp</title>
<link href="https://fonts.googleapis.com/css?family=Roboto"
rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php require 'partials/header.php' ?>
<?php if (!empty($message)): ?>
<p>
<?= $message ?>
</p>
<?php endif; ?>
<h1>Formulario de registro</h1>
<form action="signup.php" method="POST">
<input name="nombres" type="text" placeholder="Ingrese su nombre">
<input name="apellidos" type="text" placeholder="Ingrese su apellido">
<input name="email" type="text" placeholder="Ingrese su correo">
<input name="password" type="password" placeholder="Ingrese su 
contraseña">
<h3>De acuerdo con los Terminos y Condiciones</h3>
<input type="submit" value="Guardar">
</form>
<a href="login.php">¿Ya tengo una cuenta?</a></span>
</body>
</html>