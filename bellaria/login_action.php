<?php
    session_start();
    require_once('./public/connection.php');

    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "SELECT fullname , user_id FROM users WHERE status = 1 and email = '".$email."' and password = '".$password."'";
    // die($query);

    $use = $connection->query($query)->fetch_assoc();

    if ($use !== NULL) {
        setcookie('msg', 'Sign in successfull!', time() + 3);
        $_SESSION['isLogin'] = true;
        $_SESSION['use'] = $use;
        header('Location: index.php');
    } else {
        setcookie('msg', 'Sign in failed! Try again!', time() + 3);
        header('Location: signin.php');
    }
