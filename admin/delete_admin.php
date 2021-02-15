<?php
require('includes/connection.php');

if ($_GET['type'] == 'admin') {
    $query = "select store_id  from admin where admin_id = {$_GET['id']}";
    $selected_store = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($selected_store);
    $store_id = $row['store_id'];
    $query = "delete from products where store_id  = {$store_id}";
    mysqli_query($conn, $query);
    $query = "delete from store where store_id  = {$store_id}";
    mysqli_query($conn, $query);
    $query = "delete from admin where admin_id  = {$_GET['id']}";
    mysqli_query($conn, $query);
    header("location:manage_admin.php");
}
if ($_GET['type'] == 'cat') {
    $query = "select * from store where cat_id = {$_GET['id']}";
    $selected_store = mysqli_query($conn, $query);
    $row = mysqli_fetch_all($selected_store);
    foreach ($row as $store) {

        echo "<pre> store :";
        print_r($store);
        echo "</pre>";

        $query = "select * from products where store_id = {$store[0]}";
        $selected_product = mysqli_query($conn, $query);
        $row2 = mysqli_fetch_all($selected_product);
        foreach ($row2 as $pro) {
            echo "<pre> product";
            print_r($pro);
            echo "</pre>";

            $query = "delete from hot_pro where h_pro_id  = {$pro[0]}";
            mysqli_query($conn, $query);
            $query = "delete from products where pro_id  = {$pro[0]}";
            mysqli_query($conn, $query);
        }
        $query = "delete from store where store_id  = {$store[0]}";
        mysqli_query($conn, $query);
    }
    $query = "delete from category where cat_id = {$_GET['id']}";
    mysqli_query($conn, $query);
    header("location:Manage_Category.php");
}
if ($_GET['type'] == 'pro') {
    $query = "delete from products where pro_id  = {$_GET['id']}";
    mysqli_query($conn, $query);
    // header("location:Manage_products.php");
}

if ($_GET['type'] == 'store') {
    $query = "delete from products where store_id  = {$_GET['id']}";
    mysqli_query($conn, $query);
    $query = "delete from store where store_id  = {$_GET['id']}";
    mysqli_query($conn, $query);
    header("location:Manage_Stors.php");
}
if ($_GET['type'] == 'user') {
    $query = "delete from users where user_id  = {$_GET['id']}";
    mysqli_query($conn, $query);

    header("location:Manage_users.php");
}
