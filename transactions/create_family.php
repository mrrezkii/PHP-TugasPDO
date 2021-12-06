<?php

$conn = null;
include "../helper/error.php";
include "../helper/connection.php";

$name = $_POST['name'];
$id_status = $_POST['id_status'];


try {
    $query = "INSERT INTO keluarga VALUES (null, '$name', '$id_status')";
    $queryExecute = mysqli_query($conn, $query);

    if ($queryExecute) {
        header("Location: ../index.php?created=true");
    } else {
        echo "<script>alert('Store booking gagal');</script>";
    }
} catch (Exception $exception) {
    echo "ex: " . $exception;
}