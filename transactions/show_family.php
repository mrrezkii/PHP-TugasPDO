<?php

$conn = null;
include "helper/error.php";
include "helper/connection.php";

try {
    $query = "SELECT keluarga.id, keluarga.nama, status_keluarga.status FROM keluarga INNER JOIN status_keluarga ON keluarga.id = status_keluarga.id";
    $queryExecuteShowFamily = mysqli_query($conn, $query);

    if (!$queryExecuteShowFamily) {
        echo "<script>alert('Show Profile gagal');</script>";
    }
} catch (Exception $exception) {
    echo "ex: " . $exception;
}