<?php
require '../config/connect.php';

$method = $_SERVER['REQUEST_METHOD'];
switch($method){
    case 'GET':
        getAllBarang();
        break;
    case 'POST':
        createBarang();
        break;
    }
function getAllBarang()
{
    global $connect;
    $query = "SELECT * FROM tabel";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'data' => $data,
            'message' => 'Get all data success'
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to get data'
        ]);
    }

    return $result;
}
function createBarang(){
    global $connect;
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $query = "INSERT INTO tabel (nama_barang, harga, jumlah) VALUES ('$nama', '$harga', '$jumlah')";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        echo json_encode([
            'status' => '500',
            'message' => 'Query error: ' . mysqli_error($connect)
        ]);
        return;
    }
    echo json_encode([
        'status' => '200',
        'message' => 'Create data success'
]);
}