
<?php
    include_once "login_check.php";
    include "database_connection.php";
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $passwd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $passwd_confirm = filter_input(INPUT_POST, 'password-confirm', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if(!empty($username) && !empty($passwd) && !empty($passwd_confirm) && !empty($email) && $passwd==$passwd_confirm){
        $password_hash = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users`(`id`, `username`, `password`, `email`) VALUES (id, \"$username\", \"$password_hash\", \"$email\");";
        mysqli_query($conn, $sql);
    } else if($_POST){
        echo "Invalid data was provided";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/static/assets/favicon.ico" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register right now</title>
    <link rel="stylesheet" href="/static/css/style.css">
    <style>
        body{
            width: 100vw;
            height: 100vh;
            background: radial-gradient(#FFF5, #0005)
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="input-email">E-mail:</label>
        <input required type="email" name="email" id="input-email">
        <label for="input-username">Username:</label>
        <input required type="text" name="username" id="input-username">
        <label for="input-password">Password:</label>
        <input required type="password" name="password" class="input-password">
        <label for="input-password">Confirm password:</label>
        <input required type="password" name="password-confirm" class="input-password">
        <input type="submit" value="Register now">
        <p>Already registered? Log in <a href="/login.php">now</a></p>
    </form>
</body>
</html>
