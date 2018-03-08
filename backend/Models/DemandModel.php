<?php
/**
 * Created by PhpStorm.
 * User: Mhamdi. R
 * Date: 22/01/2018
 * Time: 00:54
 */

include_once(__DIR__."/../Common/Database.php");

class DemandModel {


    public function getAllDemands(){
        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('SELECT * FROM demand ORDER BY date DESC');
        $request->execute();

        $data = array();
        while($demand=$request->fetch()){
            $data[]=$demand;
        }

        return $data;
    }


    public function getRepresantDemands($represant, $id){
        $database = new Database();
        $db = $database->openConnection();

        if($represant == 'Other'){
            $request = $db->prepare('SELECT * FROM demand WHERE represant_user_id=:id ORDER BY date DESC');
            $request->execute(array(
                'id' =>$id
            ));
        }else{
            $request = $db->prepare('SELECT * FROM demand WHERE represant=:rep ORDER BY date DESC');
            $request->execute(array(
                'rep' =>$represant
            ));
        }

        $data = array();
        while($demand=$request->fetch()){
            $data[]=$demand;
        }

        return $data;
    }


    public function addDemand($title,$represant, $represant_user_id, $description,$startDate,$endDate,$requirements,$file){
        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('INSERT INTO demand VALUES (:id,:title,:date,:status,:rep, :rep_user_id, :causes) ');

        $demand= array(
            'id' => '',
            'title' => $title,
            'date' => date("Y-m-d h:i:s") ,
            'status' => 'Not Answered',
            'rep' =>$represant,
            'causes' =>'',
            'rep_user_id' => $represant_user_id
        );

        $request->execute($demand);
        $demand['id'] = $db->lastInsertId();

        $request = $db->prepare('INSERT INTO demand_detail VALUES (:id,:description,:startDate,:endDate,:req,:file,:demandId) ');

        $demandDetail= array(
            'id' => '',
            'description' => $description,
            'startDate' =>$startDate,
            'endDate' => $endDate,
            'req' => $requirements,
            'file' => $file,
            'demandId' => $demand['id']
        );
         $request->execute($demandDetail);

        return ($demand);
    }

    public function acceptDemand($id)
    {

        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('UPDATE demand SET status="Accepted" WHERE id=:id');
        $request->execute(array(
            'id'=>$id
        ));

        $request = $db->prepare('SELECT * FROM demand WHERE id=:id');
        $request->execute(array(
            'id'=>$id
        ));
        $demand=$request->fetch();

        return $demand;
    }


    public function updateDemandDetails($id, $startDate, $endDate, $requirements)
    {

        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('UPDATE demand_detail SET start_date=:sdate, end_date =:edate, requirements=:req WHERE demand_id=:id');
        $request->execute(array(
            'id'=>$id,
            'sdate' => $startDate,
            'edate' => $endDate,
            'req' =>$requirements
        ));

        $request = $db->prepare('SELECT * FROM demand WHERE id=:id');
        $request->execute(array(
            'id'=>$id
        ));
        $demand=$request->fetch();

        return $demand;
    }


    public function refuseDemand($id,$causes){

        $database = new Database();
        $db = $database->openConnection();


        $request = $db->prepare('UPDATE demand SET status="Refused",causes=:causes WHERE id=:id');
        $request->execute(array(
            'id'=>$id,
            'causes' => $causes
        ));

        $request = $db->prepare('SELECT * FROM demand WHERE id=:id');
        $request->execute(array(
            'id'=>$id
        ));

        $demand=$request->fetch();

        return $demand;

    }

    public function getDetail($id){
        $database = new Database();
        $db = $database->openConnection();

        $request = $db->prepare('SELECT d.id , d.title, d.date, det.description, det.start_date, det.end_date, det.requirements, det.file, d.status, d.causes FROM demand d, demand_detail det WHERE d.id = det.demand_id AND d.id=:id');
        $request->execute(array(
            'id'=>$id
        ));
        $detail = $request->fetch();

        return $detail;
    }

}
/*
$demand=new DemandModel();
var_dump($demand->getDetail(3));
*/
