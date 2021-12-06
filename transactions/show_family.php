<?php

$conn = null;
include "helper/error.php";
include "helper/connection.php";

$query = mysqli_query($conn, "SELECT keluarga.id, keluarga.nama, status_keluarga.status FROM keluarga INNER JOIN status_keluarga ON keluarga.id = status_keluarga.id");
$row = mysqli_num_rows($query);