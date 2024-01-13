<?php

namespace backend\mvc\pet;

use backend\library\Model;
use backend\library\RequestOperation;
use backend\library\RequestResult;
use PDO;
use Exception;

class PetModel extends Model
{
    function selectAll($id=null, $location=null): RequestResult
    {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "Select id, name, type, weight, bornDate, location from pet where (1=1)  ";  // space is necessary 
            if (isset($id)) {
                $query_string  .=   "and ( id = {$id} ) ";
            }

            if (isset($location)) {
                $query_string  .=   "and ( location like '{$location}' ) ";
            }

            $statement = $pdo->query($query_string,  PDO::FETCH_ASSOC);

            return RequestResult::requestSUCCESS(RequestOperation::SELECT, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::SELECT, "error: " . $e->getMessage());
        }
    }

    function insert(array $dataArray ): RequestResult
    {
        try {
            
            $pdo = $this->getPdoConnection();

            // prepare and bind
            $query_string = "INSERT INTO pet (name, type, weight, bornDate, location) VALUES (:name, :type, :weight, :bornDate, :location)";
            $statement = $pdo->prepare($query_string);

            $statement->execute($dataArray);

            return RequestResult::requestSUCCESS(RequestOperation::INSERT, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::INSERT, "error inserting a pet: " . $e->getMessage() );            
        }
    }

    function select($id): RequestResult
    {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "Select id, name, type, weight, bornDate, location from pet where id={$id}";  // space is necessary 
            $statement = $pdo->query($query_string,  PDO::FETCH_ASSOC);

            return RequestResult::requestSUCCESS(RequestOperation::SELECT, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::SELECT, "error: " . $e->getMessage() . 'query='. $query_string);
        }
    }

    function update(array $requestData) {
        try {
            
            if(!isset($requestData["id"])) {
                throw new Exception("The ID of the pet was not specified"); 
            }
            $dataArray = [];
            $updateFields = "";
            $dataArray["id"] = $requestData["id"];
            foreach( ["name", "type","weight","bornDate","location" ] as $field) {
                if(isset($requestData[$field])) { 
                    if($updateFields != "")  {
                        $updateFields .= ", ";
                    }
                    $updateFields .=  "{$field} = :{$field}";
                    $dataArray[$field]= $requestData[$field];
                }
            }
        
            if(strlen($updateFields)==0) {
                throw new Exception("No fields to update were specified");  
            }
            
            $query_string = "update pet set " . $updateFields . " where id = :id";

            //echo $query_string;
            //die;
            //update person set address = :address, postalcode = :postalcode where id = :id
           
            $pdo = $this->getPdoConnection();
            $statement = $pdo->prepare($query_string);
            $statement->execute($dataArray);

            $requestResult = RequestResult::requestSUCCESS(RequestOperation::UPDATE, $pdo, $statement, "pet updated with success");
            $requestResult->id = $dataArray["id"];
            return $requestResult;

        } catch (Exception $e) {
            //echo $e->getMessage();            
            return RequestResult::requestERROR(RequestOperation::UPDATE, "error updating a pet: " . $e->getMessage() );            
        }
    }

    function delete($id) {
        try {
            
            if(!isset($id)) {
                throw new Exception("The ID of the pet was not specified"); 
            }
            
            
            $query_string = "delete from pet where id = :id";

           
            $pdo = $this->getPdoConnection();
            $statement = $pdo->prepare($query_string);
            $statement->execute(  [  "id" => $id  ]    );

            $requestResult = RequestResult::requestSUCCESS(RequestOperation::DELETE, $pdo, $statement, "pet delete with success");
            $requestResult->id = $id;
            return $requestResult;
        } catch (Exception $e) {
            //echo $e->getMessage();            
            return RequestResult::requestERROR(RequestOperation::DELETE, "error updating a pet: " . $e->getMessage() . " query = " . $query_string );            
        }
    }

    
}
