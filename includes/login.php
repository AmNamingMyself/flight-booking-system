<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Get user inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //check if user exist
    $sql = "SELECT * FROM user_info Where username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found";
    }
    $conn->close();
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
}
