<?php
/**
 * Created by PhpStorm.
 * User: Mhamdi. R
 * Date: 22/01/2018
 * Time: 03:07
 */

header("Content-Type: application/json; charset=UTF-8");

session_start();

$data['id'] = $_SESSION['userId'];
$data['fullname'] = $_SESSION['fullname'];

echo json_encode($data);

