<?php
namespace backend\mvc\layouts;

use \backend\library\Controller;

class MyLayoutController extends Controller
{
    function __construct()
    {
    }
    #function showLayout($layoutPath) {
    function showLayout() {
           include(__DIR__ . "/views/main_layout.php");
    }
}
