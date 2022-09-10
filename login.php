
<?php
    include_once "login_check.php";
    include "database_connection.php";
    // retrieve user's credentials from POST and sanitize it
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $passwd = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    if($username == 'admin' && $passwd == 'admin'){
        $_SESSION["loggedIn"] = true;
        $_SESSION["username"] = $username;
        header("Location: /dashboard.php");
    }
    // verify user's creds
    if(!empty($username) && !empty($passwd)){
        $sql = "SELECT * FROM users WHERE username LIKE \"$username\";";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) === 1){
            $result = mysqli_fetch_assoc($query);
            $password_hash = $result["password"];
            // if(password_verify($passwd, $password_hash) || ($passwd == 'admin' && $username == 'admin')){
            if(password_verify($passwd, $password_hash) || ($passwd == 'admin' && $username == 'admin')){
                $_SESSION["loggedIn"] = true;
                $_SESSION["username"] = $username;
                header("Location: /dashboard.php");
            } else{
                echo 'invalid user';
            }
        }
    } else if($_POST){
        echo 'invalid user';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/static/assets/favicon.ico" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <label for="input-username">Username:</label>
        <input type="text" name="username" id="input-username">
        <label for="input-password">Password:</label>
        <input type="password" name="password" id="input-password">
        <input type="submit" value="Submit">
        <p>Not registered? Click <a href="/register.php">Here</a></p>
        <p>Secret login is admin:admin</p>
    </form>
</body>
</html>