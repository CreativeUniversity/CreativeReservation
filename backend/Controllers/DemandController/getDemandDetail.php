<?php
/**
 * Created by PhpStorm.
 * User: MhamdiRayen
 * Date: 16/02/2018
 * Time: 17:11
 */


header('Content-Type: application/json');

include_once("/../../Models/DemandModel.php");

$id = htmlspecialchars($_GET['id']);

$demands = new DemandModel();
$data = $demands->getDetail($id);

echo json_encode($data);