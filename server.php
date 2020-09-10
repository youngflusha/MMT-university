<?php

session_start();

// Initializing variables

$username = "";
$email = "";

//date_get_last_errors
$errors = array();

//connect to // DEBUG:
$db = mysqli_connect('50.87.145.180', 'univemmt_root', 'root1234', 'univemmt_database') or die("could not connect to db");



//Registering users

$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST('email');
$password = mysqli_escape_String($db, $_POST('password'))


//form validation
if(empty($username)) {
  array_push($errors, "Por favor introduza o seu nome de Usuário")
};

if(empty($email)) {
  array_push($errors, "Por favor introduza o seu nome de email")
};
if(empty($password)) {
  array_push($errors, "Por favor introduza a sua senha")
};

// db for existing user with same $username

$user_check_query = "SELECT * FROM accounts WHERE username = '$username' or '$email' = '$email' LIMIT 1";

$results = mysqli_query( $db, $user_check_query);
$user = mysqli_fetch_assoc($results);

if ($user){
  if($user['username'] === $username) {array_push($errors, "Esse nome de usuário não está disponível.");}
  if($user['email'] === $email) {array_push($errors, "Esse endereço de email não está disponível");}
}

//Register User if no error

if(count($errors) === 0){
  $password = md5($password); //this will encript password.
  $query = "INSERT INTO accounts (username, email, password) VALUES ($username, $email, $password)";
  mysqli_query($db, $query);
  $_SESSION['username'] = $username;
  $_SESSION['Success'] = 'You are now logged in';

  header('location: login.html');
}
