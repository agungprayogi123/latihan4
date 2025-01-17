<?php
$hostname = "Localhost";
$username = "root";
$password = "";
$database = "db_tugas1";
$connect = mysqli_connect($hostname, $username, $password, $database);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    // echo "koneksi database berhasil";
}