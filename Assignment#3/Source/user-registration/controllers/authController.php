<?php

session_start();

require 'config/db.php';

$errors = array();
$name = "";
$email = "";

// signup
if(isset($_POST['signup-btn'])) {
  // Get values from the form
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordConfirm = $_POST['passwordConfirm'];

  // Validate form inputs
  if(empty($name)) { 
    $errors['name'] = "Name is required";
  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Email address is invalid";
  }
  if(empty($email)) {
    $errors['email'] = "Email address is required";
  }
  if(empty($password)) {
    $errors['password'] = "Password is required";
  }
  if($password !== $passwordConfirm) {
    $errors['password'] = "Passwords do not match";
  }

  // Checking for duplicate emails in the database
  $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
  $stmt = $connection->prepare($emailQuery);
  $stmt->bind_param('s', $email);
  $stmt->execute();

  $result = $stmt->get_result();
  $userCount = $result->num_rows;
  $stmt->close();

  if($userCount > 0) {
    $errors['email'] = "Email address already exists";
  }

  // If there's no errors save the user to the database
  if(count($errors) === 0) {
    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // generate token
    $token = bin2hex(random_bytes(50));

    // query to save user
    $sql = "INSERT INTO users (name, email, token, password) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ssss', $name, $email, $token, $password);
    // if statement is executed successfully
    if($stmt->execute()) {
      // login user and save data about the user in the session
      $user_id = $connection->insert_id;
      $_SESSION['id'] = $user_id;
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      // display flash message
      $_SESSION['message'] = "You are now logged in!";
      $_SESSION['alert-class'] = "alert-success";
      // redirect to index page
      header('location: index.php');
      exit();
    } else {
      $errors['db_error'] = "Database Error: Failed to register";
    }
  }
}

// login
if(isset($_POST['login-btn'])) {
  // Get values from the form
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate form inputs
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Email address is invalid";
  }
  if(empty($email)) {
    $errors['email'] = "Email address is required";
  }
  if(empty($password)) {
    $errors['password'] = "Password is required";
  }

  if(count($errors) === 0) {
    // Check if user with entered email exist in the db
    $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
  
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
  
    // Verify password
    if(password_verify($password, $user['password'])) {
      // login user and save data about the user in the session
      $_SESSION['id'] = $user['id'];
      $_SESSION['name'] = $user['name'];
      $_SESSION['email'] = $user['email'];
      // display flash message
      $_SESSION['message'] = "You are now logged in!";
      $_SESSION['alert-class'] = "alert-success";
      // redirect to index page
      header('location: index.php');
      exit();
    } else {
      // login failed
      $errors['login_fail'] = "Authentication failed";
    }
  }
}

// logout user
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['id']);
  unset($_SESSION['name']);
  unset($_SESSION['email']);
  header('location: login.php');
  exit();
}