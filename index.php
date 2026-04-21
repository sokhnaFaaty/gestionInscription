<?php
function filtrerStudentParFormation($students, $formationId){
    $studentsFiltres = [];
    foreach($students as $student){
        if(isset($student['id_formation']) && $student['id_formation'] == $formationId){
            $studentsFiltres[] = $student;
        }
    }
    return $studentsFiltres;
}