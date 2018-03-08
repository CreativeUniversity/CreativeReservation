<?php
/**
 * Created by PhpStorm.
 * User: MhamdiRayen
 * Date: 09/02/2018
 * Time: 21:27
 */


header('Content-Type: application/json');


include_once("/../../Models/UserModel.php");

$user = new UserModel();
$users = $user->getAllUsers();

echo json_encode($users);