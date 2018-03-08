<?php
/**
 * Created by PhpStorm.
 * User: Mhamdi. R
 * Date: 22/01/2018
 * Time: 00:54
 */

include_once(__DIR__."/../Common/Database.php");

class UserModel {


    public function searchUser($login, $pwd){
        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('SELECT * FROM user WHERE login=:login AND password=:pwd');
        $request->execute(array(
            'login' => $login,
            'pwd' => $pwd
        ));

        if($request->rowCount() == 1){
            $data['exist'] = 1;
            $data['user'] = $request->fetch();
        }else{
            $data['exist'] = 0;
            $data['user'] = '';
        }

        return $data;
    }

    public function searchUserById($id){
        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('SELECT * FROM user WHERE id=:id');
        $request->execute(array(
            'id' => $id
        ));

        return $request->fetch();
    }

    public function existUser($login, $pwd)
    {
        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('SELECT * FROM user WHERE login=:login AND password=:pwd');
        $request->execute(array(
            'login' => $login,
            'pwd' => $pwd
        ));

        if ($request->rowCount() == 1) {
            $data['exist'] = 1;
        } else {
            $data['exist'] = 0;
        }

        return $data;
    }

    public function saveUser($fullname, $login, $pwd, $mail, $phone, $represant){
        $database = new Database();
        $db = $database->openConnection();


        $request = $db->prepare('INSERT INTO user VALUES (:id, :fullname, :login, :password, :email, :phone, :represant, :status)');

        $user = array(
            'id' => '',
            'fullname' => $fullname,
            'login' => $login,
            'password' => $pwd,
            'email' => $mail,
            'phone' => $phone,
            'represant' => $represant,
            'status' => 'Passif'
        );

        $request->execute($user);

        $user['id'] = $db->lastInsertId();


        return ($user);

    }

    public function getAllUsers()
    {

        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('SELECT * FROM user WHERE represant <> "Admin" AND represant <> "General"');
        $request->execute();

        while ($user = $request->fetch()) {
            $data[] = $user;
        }
        return $data;

        $database->closeConnection();
    }

    public function confirmUser($id)
    {

        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('UPDATE user SET status="Actif" WHERE id=:id');
        $request->execute(array(
            'id'=>$id
        ));

        $request = $db->prepare('SELECT * FROM user WHERE id=:id');
        $request->execute(array(
            'id'=>$id
        ));
        $user=$request->fetch();

        return ($user);
    }

    public function refuseUser($id){

        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('SELECT * FROM user WHERE id=:id');
        $request->execute(array(
            'id'=>$id
        ));
        $user=$request->fetch();

        $request = $db->prepare('DELETE FROM user WHERE id=:id');
        $request ->execute(array(
            'id'=>$id
        ));



        return ($user);

    }

    public function getDetails($id){

        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('SELECT * FROM user WHERE id=:id');
        $request->execute(array(
            'id'=>$id
        ));

        $data = $request->fetch();

        return($data);
    }

}