<?php

$conn = null;
include "../helper/error.php";
include "../helper/connection.php";

$id = $_POST['id'];

try {
    $query = "DELETE FROM keluarga WHERE id = '$id'";
    $queryExecute = mysqli_query($conn, $query);

    if (!$queryExecute) {
        echo "<script>alert('Delete booking input');</script>";
    }

    header("refresh:0.1; URL= ../index.php?deleted=true");
} catch (Exception $exception) {
    echo "ex: " . $exception;
}