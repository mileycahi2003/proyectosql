<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE
id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
}

?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <title>bienvenidos aprendices</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" 
rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">


 </head>
<body>
    <?php require 'partials/header.php' ?>
    
    <?php if(!empty($user)): ?>
        <br> bienvenido. <?= $user['email']; ?>
        <br> el login fue exitoso.
        <a href="logout.php">cierre de sesion</a>
        <?php else: ?>
            <h3>si ya tienes cuentas,igresa!! si no la tienes, te invito a registrarte</h3>
            <a href=" login.php">ingreso</a> o
            <a href="signup.php">registro</a>
            <?php endif; ?>
            <div style="display: flex; justify-content: center; alig_items: center;
         height: 70vh;">
            <img src="partials/img/images.jpg" alt="algo bonito">
        </div>
</body>
</html>