<?php
/**
 * Created by PhpStorm.
 * User: MhamdiRayen
 * Date: 21/02/2018
 * Time: 23:51
 */

header('Content-Type: application/json');

include_once(__DIR__."/../../Models/DemandModel.php");

$id = $_POST['id'];
$cause = $_POST['cause'];

$demand = new DemandModel();
$data = $demand->refuseDemand($id,$cause);

echo json_encode($data);