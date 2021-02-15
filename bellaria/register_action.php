<?php
require_once './public/connection.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');

$fullname = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

if ($password2 != $password) {
    setcookie('msg', 'Retype the password incorrectly!', time() + 3);
    header('Location: register.php');
} else {
    $created_at = date('Y-m-d H:i:s');
    $status = 1;

  
    // $password = password_hash($password, PASSWORD_BCRYPT);
    $password = sha1($_POST['password']);

    $query = "INSERT INTO users(email, password, fullname, status, created_at) VALUES ('" . $email . "', '" . $password . "', '" . $fullname . "', '" . $status . "', '" . $created_at . "')";
    // die($query);

    $result = $connection->query($query);
    // echo $result; die;

      if ($result) {
        setcookie('msg', 'Register successful!', time() + 3);
        header('Location: signin.php');
    } else {
        setcookie('msg', 'Register Failed!', time() + 3);
        header('Location: register.php');
    }
}

// echo $fullname.'<br/>'.$username.'<br/>'.$password.'<br/>'.$password2; die;
