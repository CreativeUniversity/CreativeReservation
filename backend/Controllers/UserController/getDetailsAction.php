<?php
/**
 * Created by PhpStorm.
 * User: Nomad Vin26
 * Date: 06/02/2018
 * Time: 20:37
 */

header('Content-Type: application/json');
include_once("/../../Models/UserModel.php");

$id = $_GET['Id'];


$user = new UserModel();
$data = $user->getDetails($id);


$to = $data['email'];
$email = "CreativeReservation@creativelab-club.com";
$subject = "your informations";
$txt = "ok this is the text";

mail($to, $subject, $txt, "From: ".$email);

echo json_encode($data);