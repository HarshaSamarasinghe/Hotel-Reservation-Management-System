<?php

session_start();
require_once 'config.php';

//Hnadles the registration process
if(isset($_POST['register'])){
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phoneNumber'];
    $passwordToBeEncrypted = $_POST['password'];
    $password = password_hash($passwordToBeEncrypted, PASSWORD_DEFAULT);
    $confirmPassword = $_POST['confirmPassword'];

    $checkEmail = $conn->query("SELECT uEmail FROM users WHERE uEmail = '$email'");
    if($checkEmail->num_rows > 0){
        $_SESSION['alerts'][] = [
            'type' => 'error',
            'message' => 'Email already exists. Please try another!'
        ];
        $_SESSION['active_form'] = 'register';
    }
    // else if($passwordToBeEncrypted != $confirmPassword){
    //     $_SESSION['alerts'][] = [
    //         'type' => 'error',
    //         'message' => 'Passwords do not match. Please try again!'
    //     ];

    // }
    else{
        $conn->query("INSERT INTO users (uFullName, uEmail, uPhoneNumber, uPassword, confirmPassword) VALUES ('$name', '$email', '$phone', '$password', '$confirmPassword')");
        $_SESSION['alerts'][] = [
            'type' => 'success',
            'message' => 'Successful! You can now login.'
        ];
        $_SESSION['active_form'] = 'login';
    }

    header('Location: getStarted.php');
    exit();
}

//Handles the login process
if(isset($_POST['login'])){
    $email = $_POST['userName'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE uEmail = '$email'");
    $user = $result->num_rows > 0 ? $result->fetch_assoc() : null;

    if($user && password_verify($password, $user['uPassword'])){
        $_SESSION['name'] = $user['uFullName'];
        $_SESSION['alerts'][] = [
            'type' => 'success',
            'message' => 'Login Successful'
        ];
        header('Location: bookNow.php');
        exit();
         
    }
    else{
        $_SESSION['alerts'][] = [
            'type' => 'error',
            'message' => 'Incorrect Email or Password!!'
        ];
        $_SESSION['active_form'] = 'login';
        header('Location: getStarted.php');
        exit();
        
    }
   
}
?>