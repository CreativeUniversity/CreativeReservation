<?php
/**
 * Created by PhpStorm.
 * User: MhamdiRayen
 * Date: 16/02/2018
 * Time: 16:52
 */

header('Content-Type: application/json');

include_once("/../../Models/DemandModel.php");

$demands = new DemandModel();
$data = $demands->getAllDemands();

echo json_encode($data);