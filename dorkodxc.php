<?php
    class Conection {
        static public function conect(){
            try{
                $link= new PDO("mysql:host=localhost;dbname=wesharp2","root","");
                $link->exec("set names utf8");
            }catch(PDOException $e){
                die("error: ". $e->getMessage());
            }
            return $link;
        }
    }

    class Model{
        static public function getData($table, $select, $linkTo, $equalTo){
            $stmt=Conection::conect()->prepare("SELECT $select FROM $table WHERE $linkTo  = :$linkTo");
            $stmt -> bindParam(":".$linkTo, $equalTo, PDO::PARAM_STR);
            if($stmt->execute()){
                return $stmt->fetchAll();
            }
        }

        static public function deleteData($table, $id, $nameId){
            $stmt = Conection::conect()->prepare("DELETE FROM $table WHERE $nameId = :$nameId");
            $stmt->bindParam(":".$nameId, $id, PDO::PARAM_INT);
            if($stmt->execute()){
                return "The process was successfull";
            }else{
                return Conection::conect()->errorInfo();
            }
            
        }
    }

    class Controller {
        static public function getData($table, $select, $linkTo, $equalTo){
            $response = Model::getData($table, $select, $linkTo, $equalTo);
            return $response;
        }

        static public function deleteData($table, $id, $nameId){
            $response = Model::deleteData($table, $id, $nameId);
            return $response;
        }
    }

    // vista
    $table = array("sale", "order");
    foreach($table as $key => $value){
        $response = Controller::getData($value."s", "id_".$value, "status_".$value, "test");
        if(isset( $response[0]["id_".$value])){
            $delete = Controller::deleteData($value."s", $response[0]["id_".$value], "id_".$value);
            print_r($delete);
        }
    }
?>