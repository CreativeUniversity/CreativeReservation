<?php
/**
 * Created by PhpStorm.
 * User: MhamdiRayen
 * Date: 16/02/2018
 * Time: 16:52
 */

header('Content-Type: application/json');

include_once("/../../Models/DemandModel.php");


$represant = $_POST['rep'];
$id = $_POST['id'];

$demands = new DemandModel();
$data = $demands->getRepresantDemands($represant, $id);

echo json_encode($data);