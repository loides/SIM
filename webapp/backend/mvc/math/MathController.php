<?php

namespace backend\mvc\math;


use Exception;
use backend\library\Controller;
use backend\library\RequestOperation;
use backend\library\RequestResult;

use backend\mvc\math\MathModel;

class MathController extends Controller  {

    function __construct() { 
    }

    function findRootValues()
    {
        $a = $_REQUEST["a"];
        $b = $_REQUEST["b"];
        $c = $_REQUEST["c"];
        $model = new MathModel();
        $result = $model->findRootValues($a, $b, $c);
        $result["equation"] = "($a)x^2 + ($b)x + ($c) = 0";
        header("Content-Type: application/json, charset=utf-8");
        echo json_encode($result);
        //include(__DIR__ ."/views/showRootValues.php");
    }

    function showQuadraticForm()
    {
        include(__DIR__ ."/views/showQuadraticForm.php");
    }

}
