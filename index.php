<?php 
function arrayToJson(){
    $json = file_get_contents('data.json');
    $data = json_decode($json, true);
    return $data;
}

function jsonToArray($data){
    $json = json_encode($data);
    file_put_contents('data.json', $json);
}