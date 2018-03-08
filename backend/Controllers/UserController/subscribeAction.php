<?php
/**
 * Created by PhpStorm.
 * User: Nomad Vin26
 * Date: 28/01/2018
 * Time: 18:01
 */
include_once("/../../Models/UserModel.php");

$fullname = htmlspecialchars($_POST['fullname']);
$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['pwd']);
$mail = htmlspecialchars($_POST['mail']);
$phone = htmlspecialchars($_POST['phone']);
$represant = htmlspecialchars($_POST['represant']);
$status = "Passif";

$userToSave = new UserModel();
$user = $userToSave->saveUser($fullname,$login,$password, $mail, $phone,$represant, $status);


session_start();

$_SESSION["userId"] = $user['id'];
$_SESSION["fullname"] = $user['fullname'];


echo json_encode($user);