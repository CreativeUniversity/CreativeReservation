<?php
/**
 * Created by PhpStorm.
 * User: Nomad Vin26
 * Date: 06/02/2018
 * Time: 20:06
 */


header('Content-Type: application/json');

include_once(__DIR__."/../../Models/UserModel.php");


$id = $_GET['Id'];

$user = new UserModel();
$data = $user->confirmUser($id);

$to = $data['email'];
$email = "CreativeReservation@creativelab-club.com";
$subject = "We are accpeting your membership request";
$txt = "ok this is the text";

mail($to, $subject, $txt, "From: ".$email);


echo json_encode($data);
