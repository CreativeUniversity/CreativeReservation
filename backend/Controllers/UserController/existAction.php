<?php
/**
 * Created by PhpStorm.
 * User: Nomad Vin26
 * Date: 27/01/2018
 * Time: 13:09
 */

include_once("/../../Models/UserModel.php");


$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['pwd']);


$user = new UserModel();
$data = $user->existUser($login,$password);
$existence=$data['exist'];

echo json_encode($existence) ;
