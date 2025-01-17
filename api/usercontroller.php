<?php
require '../config/connect.php';

$method = $_SERVER['REQUEST_METHOD'];
switch($method){
    case 'GET':
        getAllUser();
        break;
    case 'POST':
        createUser();
        break;
    case 'DELETE':
        deleteUser();
        break;
    case 'PUT':
        updateUser();
        break;
    }
function getAllUser()
{
    global $connect;
    $query = "SELECT * FROM user";
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
function createUser(){
    global $connect;
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "INSERT INTO user (id, username, password) VALUES ('$id', '$username', '$password')";
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
function deleteUser(){
    global $connect;
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    $id = $data['id'];
    $query = "DELETE FROM user WHERE id = '$id'";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        echo json_encode([
            'status' => '401',
            'message'=> 'Query error: ' . mysqli_error($connect)
        ]);
        return;
    }
    echo json_encode([
        'status' => '200',
        'message' => 'Success Delete user'
    ]);
}
function updateUser()
{
    global $connect;
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    $id = $data['id'];
    $username = $data['username'];
    $password = $data['password'];
    $query = "UPDATE user SET username = '$username', password = '$password' WHERE id = '$id'";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        echo json_encode([
            'status' => '401',
            'message'=> 'Query error: ' . mysqli_error($connect)
        ]);
        return;
    }
    echo json_encode([
        'status' => '201',
        'message' => 'Update user sukses'
    ]);
}