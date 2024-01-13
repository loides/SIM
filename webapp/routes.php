<?php
use backend\library\Route;

//                      ----------------------------- // ------------------------------------------ Layout

Route::route("showLayout", function(){    
    (new backend\mvc\layouts\MyLayoutController())->showLayout();  
});



//                      ----------------------------- // ------------------------------------------ Tests

Route::route("say_hello", function() {
    echo '<H1>Hello world.</H1>';
});

Route::route("rootValues", function(){      
    (new backend\mvc\math\MathController())->findRootValues();   
});

Route::route("showQuadraticForm", function(){
    (new backend\mvc\math\MathController())->showQuadraticForm();
});



//                      ----------------------------- // ------------------------------------------ Person

Route::route("selectAllPeople", function(){                             //http://localhost/webapp/app.php?service=selectAllPeople
    (new backend\mvc\person\PersonController())->selectAll();    
});

Route::route("showPeopleAsTable", function(){                           //http://localhost/webapp/app.php?service=showPeopleAsTable
    (new backend\mvc\person\PersonController())->showPeopleAsTable();
});

Route::route("showPersonForm", function(){
    (new backend\mvc\Person\PersonController())->showPersonForm( @$_REQUEST["MODE"], @$_REQUEST["id"]);  
});

Route::route("insertPersonFromView", function(){
    (new backend\mvc\Person\PersonController())->insertFromView();  
});

Route::route("selectPerson", function(){    
    (new backend\mvc\Person\PersonController())->select(@$_REQUEST['id']);  
});

Route::route("updatePerson", function(){    
    (new backend\mvc\person\PersonController())->update();  
});

Route::route("deletePerson", function(){    
    (new backend\mvc\person\PersonController())->delete(@$_REQUEST['id']);  
});



//                      ----------------------------- // ------------------------------------------ Video

Route::route("playVideo", function(){    
    (new backend\mvc\person\PersonController())->playVideo(@$_REQUEST['id']);  
});



//                      ----------------------------- // ------------------------------------------ Pets


Route::route("selectAllPets", function(){                             //http://localhost/webapp/app.php?service=selectAllPeople
    (new backend\mvc\pet\PetController())->selectAll();    
});

Route::route("showPetsAsTable", function(){                           //http://localhost/webapp/app.php?service=showPeopleAsTable
    (new backend\mvc\pet\PetController())->showPetsAsTable();
});

Route::route("showPetForm", function(){
    (new backend\mvc\Pet\PetController())->showPetForm( @$_REQUEST["MODE"], @$_REQUEST["id"]);  
});

Route::route("insertPetFromView", function(){
    (new backend\mvc\Pet\PetController())->insertFromView();  
});

Route::route("selectPet", function(){    
    (new backend\mvc\Pet\PetController())->select(@$_REQUEST['id']);  
});

Route::route("updatePet", function(){    
    (new backend\mvc\pet\PetController())->update();  
});

Route::route("deletePet", function(){    
    (new backend\mvc\pet\PetController())->delete(@$_REQUEST['id']);  
});

