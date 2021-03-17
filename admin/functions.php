<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
}

function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($con,$str){
    if($str!=''){
        $str=trim($str);
        return $con->quote($str);
    }
}


function CreateTable($tableName){
    $columns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME= '$tableName'";
    $table = '<table>';
}
