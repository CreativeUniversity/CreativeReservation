<?php
/**
 * Created by PhpStorm.
 * User: MhamdiRayen
 * Date: 22/02/2018
 * Time: 00:12
 */

header('Content-Type: application/json');

include_once(__DIR__."/../../Models/DemandModel.php");

$id = $_POST['id'];
$sdate = $_POST['StartDate'];
$edate = $_POST['EndDate'];
$req = $_POST['requirements'];

$demand = new DemandModel();
$data = $demand->updateDemandDetails($id, $sdate, $edate, $req);

echo json_encode($data);