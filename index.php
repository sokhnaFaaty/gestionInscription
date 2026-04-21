<?php
function deleteStudent($id){
    $data = arrayToJson();
    foreach($data['students'] as $key => $student){
        if($student['id'] == $id){
            unset($data['students'][$key]);
            $data['students'] = array_values($data['students']);
            jsonToArray($data);
            return true;
        }
    }
    return false;
}

function deleteFormation($id){
    $data = arrayToJson();
    foreach($data['formations'] as $key => $formation){
        if($formation['id'] == $id){
            unset($data['formations'][$key]);
            $data['formations'] = array_values($data['formations']);
            jsonToArray($data);
            return true;
        }
    }
    return false;
}
