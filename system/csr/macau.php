<?php
    session_start();
    include '../function.php';
    include '../dbms/conn.php';

    $id = $_GET['country'];

    $update_country = "UPDATE upti_users SET users_employee = 'MACAU' WHERE users_id = '$id'";
    $update_country_sql = mysqli_query($connect, $update_country);

    flash("country", "Welcome to MACAU Country");
    header('location: ../branch.php');
?>