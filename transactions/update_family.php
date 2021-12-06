<?php

$conn = null;
include "../helper/error.php";
include "../helper/connection.php";

$id = $_POST['id'];
$name = $_POST['name'];
$id_status = $_POST['id_status'];

try {
    $query = "UPDATE keluarga SET nama = '$name' , id_status = '$id_status' WHERE id = '$id';";
    $queryExecute = mysqli_query($conn, $query);

    if ($queryExecute) {
        header("refresh:0.1; URL= ../index.php?updated=true");
    } else {
        echo "<script>alert('Update Profile gagal');</script>";
    }
} catch (Exception $exception) {
    echo "ex: " . $exception;
}