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

    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $user = $_POST['name'];

    if($password != $password2){
        echo "Les contrasenyes no son coincidents.";
    }

    $sql = "SELECT * FROM users WHERE (username = '$user' OR email = '$user') AND contra = '$password'";        
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: index.html");
    } else {
        header("Location: error.html");
    }

    $conn->close();
?>
