<?php
/**
 * Created by PhpStorm.
 * User: MhamdiRayen
 * Date: 21/02/2018
 * Time: 23:38
 */

header('Content-Type: application/json');

include_once(__DIR__."/../../Models/DemandModel.php");

$id = $_POST['id'];

$demand = new DemandModel();
$data = $demand->acceptDemand($id);

echo json_encode($data);