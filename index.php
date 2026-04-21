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
}