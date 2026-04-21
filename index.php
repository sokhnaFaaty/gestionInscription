<?php
function getAllStudents(){
    $data = arrayToJson();
    return $data['students'] ?? [];
}
function getStudentById($id){
    $data = arrayToJson();
    foreach($data['students'] as $student){
        if($student['id'] == $id){
            return $student;
        }
    }
    return null;
}

//formations
function getAllFormations(){
    $data = arrayToJson();
    return $data['formations'] ?? [];
}


function getFormationById($id){
    $data = arrayToJson();
    foreach($data['formations'] as $formation){
        if($formation['id'] == $id){
            return $formation;
        }
    }
    return null;
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