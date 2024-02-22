<?php

    $serverName = "localhost";
    $userName = "root";
    $passWord = "";
    $dbName = "scrawled";

    $conn = new mysqli($serverName, $userName, $passWord, $dbName);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
        header("Location: error.html");
    }

    $name = $_POST['name'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $user = $_POST['username'];
    $email = $_POST['email'];

    if($password != $password2){
        echo "Les contrasenyes no son coincidents.";
        die;
    } else if (strlen($user) < 5){
        echo "El nom d'usuari ha de ser de com a mínim 5 caràcters.";
     } else {

        $sql = "INSERT INTO scrawled.users(nom, contra, username, email, dificulty)
            VALUES ('$name', '$password', '$user', '$email', 1)";
            
        $result = $conn->query($sql);
    }

    if ($result) {
        header("Location: index.html");
    }

    $conn->close();
?>
