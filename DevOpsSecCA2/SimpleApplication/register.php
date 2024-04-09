<?php
include 'db.php';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Register</h1>
        
        <form method="post" action="" class="mt-3">
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" name="register" class="btn btn-dark">Register</button>
</form>
        <p class="mt-3">Return to login <a href="login.php">Login</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="site.css">
</body>
</html>

