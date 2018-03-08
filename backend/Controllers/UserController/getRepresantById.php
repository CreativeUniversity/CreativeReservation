<?php
/**
 * Created by PhpStorm.
 * User: Nomad Vin26
 * Date: 24/01/2018
 * Time: 18:53
 */

header("Content-Type: application/json; charset=UTF-8");

include_once("/../../Models/UserModel.php");

$id = $_POST['id'];

$user = new UserModel();
$data = $user->searchUserById($id);

echo json_encode($data['represant']);
