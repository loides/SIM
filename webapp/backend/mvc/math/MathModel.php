<?php

namespace backend\mvc\math;


use Exception;
use backend\library\Model;
use backend\library\RequestOperation;
use backend\library\RequestResult;

class MathModel extends Model  {
    function findRootValues($a, $b, $c)
    {
        $delta = $b * $b - 4 * $a * $c;
        if ($delta >= 0) {
            $sqrtDelta = sqrt($delta);
            $x1 = (-$b + $sqrtDelta) / (2.0 * $a);
            $x2 = (-$b - $sqrtDelta) / (2.0 * $a);
        } else {
            $sqrtDelta = sqrt(-$delta);
            $realPart = (-$b) / (2 * $a);
            $imaginaryPart =  $sqrtDelta / (2.0 * $a);

            $x1 = "$realPart+$imaginaryPart" . "i";
            $x2 = "$realPart-$imaginaryPart" . "i";;
        }
        $arrayResult = ["x1" => $x1, "x2" => $x2];
        return $arrayResult;
    }
}
