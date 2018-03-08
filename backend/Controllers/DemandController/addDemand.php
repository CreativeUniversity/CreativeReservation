<?php
/**
 * Created by PhpStorm.
 * User: MhamdiRayen
 * Date: 22/02/2018
 * Time: 04:15
 */


include_once(__DIR__."/../../Models/DemandModel.php");

$demand_title = htmlspecialchars($_POST['Dtitle']);
$demand_description = htmlspecialchars($_POST['Ddescription']);
$demand_startDate = $_POST['DstartDate'].' '.$_POST['DstartTime'];
$demand_endDate = $_POST['DendDate'].' '.$_POST['DendTime'];
$demand_requirements = htmlspecialchars($_POST['Drequirements']);
$demand_represant = htmlspecialchars($_POST['represant']);
$demand_represant_id_user = htmlspecialchars($_POST['represant_id_user']);



if($_FILES['file']['name'] === ""){
    echo 'i am here';

    $demand = new DemandModel();
    $demand->addDemand($demand_title,$demand_represant,$demand_represant_id_user,$demand_description,$demand_startDate,$demand_endDate,$demand_requirements,'');

    header("location: ../../../public/views/UserDemandsUI.html?successMSG=the Demand added successfully");

}

if($_FILES['file']['name'] !== ""){

    $target_dir = "../../../public/assets/uploads/".$demand_represant."/";

    $char_spec = array(" ", "°", "<", ">", "*", "/", "$", "^", "²");
    $filename = str_replace($char_spec,'_',basename($_FILES["file"]["name"]));
    $target_file = $target_dir . $filename;


    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
    if (file_exists($target_file)) {
        header("location: ../../../public/views/UserDemandsUI.html?errorMSG=Sorry, file already exists.");
        return false;
    }
// Check file size
    if ($_FILES["file"]["size"] > 21000000) {
        header("location: ../../../public/views/UserDemandsUI.html?errorMSG=Sorry, your file is too large.");
        return false;
    }
// Allow certain file formats
    if($FileType != "zip" && $FileType != "png" && $FileType != "jpg" && $FileType != "pdf") {
        header("location: ../../../public/views/UserDemandsUI.html?errorMSG=Sorry, only ZIP, PNG, JPG and PDF files are allowed.");
        return false;
    }


    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

        $demand = new DemandModel();
        $filetoUpload = $demand_represant."/".$filename;

        $demand->addDemand($demand_title,$demand_represant,$demand_represant_id_user,$demand_description,$demand_startDate,$demand_endDate,$demand_requirements,$filetoUpload);
        echo "uploaded with file";
        header("location: ../../../public/views/UserDemandsUI.html?successMSG=the Demand added successfully");

    } else {
        header("location: ../../../public/views/UserDemandsUI.html?errorMSG=Sorry, there was an error uploading your file.");
    }

}




