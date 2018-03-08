<?php
/**
 * Created by PhpStorm.
 * User: Nomad Vin26
 * Date: 24/01/2018
 * Time: 18:53
 */
include_once("/../../Models/UserModel.php");

$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['pwd']);

$user = new UserModel();
$data = $user->searchUser($login,$password);

if($data['exist']==0){
    header("location: ../../../public/views/connectionUI.html?msg=User not Registred");
}else{

    $userData=$data['user'];

    if($userData['status'] == "Passif"){
        header("location: ../../../public/views/connectionUI.html?msg=Wait for Confirmation");
    }else{

        session_start();

        $_SESSION["userId"] = $userData['id'];
        $_SESSION["fullname"] = $userData['fullname'];


        if($userData['represant']=="Admin") {
            header("location: ../../../public/views/AdminDemandsUI.html");
        }elseif ($userData['represant'] == 'General') {
            header("location: ../../../public/views/GeneralDemandsUI.html");
        }else {
            header("location: ../../../public/views/UserDemandsUI.html");
        }
    }

}
