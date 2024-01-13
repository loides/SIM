<?php

namespace backend\mvc\pet;

use \backend\library\Controller;
use \backend\library\RequestOperation;
use \backend\library\RequestResult;

use \backend\mvc\pet\PetModel;
use \Exception;

class PetController extends Controller
{
    function __construct()
    {

    }

    // http://localhost/app.php?service=selectPeople
    function selectAll()
    {
        // we could define functions like selectPersonCity, selectPerson
        $petModel = new PetModel();
        $id          = @$_REQUEST["id"  ];
        $location        = @$_REQUEST["location"];    
        $petModel->selectAll($id, $location)->toJsonEcho();
    }

    function showPetsAsTable() {
        //$folder = __DIR__;
        //include("./$folder/views/showPetsAsTable.php");
        include(__DIR__ . '/views/showPetsAsTable.php');
    }

    function insertFromView() {
        // perform some validation, like empty fields
        // or invalid values, ...
        $msgError = "Error:";
        $hasError = false;
        if(empty( @$_REQUEST["name"]) ) {
            $msgError .= ' name not provided.';
            $hasError  = true;
        } else if(empty( @$_REQUEST["type"]) ) {
            $msgError .= ' type not provided.';
            $hasError  = true;
        } else if(empty( @$_REQUEST["weight"]) ) {
            $msgError .= ' weight not provided.';
            $hasError  = true;
        }else if(empty( @$_REQUEST["bornDate"]) ) {
            $msgError .= ' bornDate not provided.';
            $hasError  = true;
        }else if(!is_numeric( @$_REQUEST["weight"]) ) {
            $msgError .= ' weight must be a number.';
            $hasError  = true;
        }else if(empty( @$_REQUEST["location"]) ) {
            $msgError .= 'location not provided.';
            $hasError  = true;
        }    
        
        else {
            $this->insert();  
        }
        if($hasError) {
            RequestResult::requestERROR(RequestOperation::INSERT, $msgError)->toJsonEcho();
        }
    }

    function insert() {        
        $requestData = array(
            "name"       => @$_REQUEST["name"],
            "type"       => @$_REQUEST["type"],
            "weight"     => @$_REQUEST["weight"],
            "bornDate"   => @$_REQUEST["bornDate"],
            "location"   => @$_REQUEST["location"] 
        );
        $petModel = new PetModel();
        $petModel->insert($requestData)->toJsonEcho();
    }

    function showPetForm($mode, $id) {
        $_GET['MODE']=$mode;
        $_GET['id']  = $id;
        //$folder = __DIR__;
        //include("./$folder/views/showPetForm.php"); //MODE: INSERT, UPDATE, SEE
        include(__DIR__ . '/views/showPetForm.php');
    }

    function select($id)
    {
        // we could define functions like selectPersonCity, selectPerson
        $petModel = new PetModel();  
        $petModel->select($id)->toJsonEcho();
    }

    function update()  {
        $requestData = array(
            "id"         => @$_REQUEST["id"],
            "name"       => @$_REQUEST["name"],
            "type"       => @$_REQUEST["type"],
            "weight"     => @$_REQUEST["weight"],
            "bornDate"   => @$_REQUEST["bornDate"],
            "location"   => @$_REQUEST["location"] 
        );
        $petModel = new PetModel();
        $petModel->update($requestData)->toJsonEcho();
    }

    function delete($id)  {
        
        $petModel = new PetModel();
        $petModel->delete($id)->toJsonEcho();
    }

    /*function playVideo() {
        $arraMusic =[
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/jh4C7w-dvho" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/ZtmIokzkeyA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/WKuaujIHBT4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
        ];
        $size = count($arraMusic);
        $music = rand(0, $size-1);
        echo $arraMusic[$music]; 

    }*/




}