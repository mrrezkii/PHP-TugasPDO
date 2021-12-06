<?php

$conn = null;
include "helper/error.php";
include "helper/connection.php";

try {
    $query = "SELECT * FROM status_keluarga";
    $queryExecuteShowStatus = mysqli_query($conn, $query);

    if (!$queryExecuteShowStatus) {
        echo "<script>alert('Show Profile gagal');</script>";
    }
} catch (Exception $exception) {
    echo "ex: " . $exception;
}