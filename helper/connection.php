<?php
$server = "localhost";
$user = "rezki";
$password = "1202190044";
$db = "keluarga";

$conn = mysqli_connect($server, $user, $password, $db);
if (!$conn) {
    echo "Server not found" . mysqli_error($conn);
}