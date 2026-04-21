<?php
function modifierStudent($modifierStudent){
    $data = arrayToJson();
    foreach($data['students'] as $key => $student){
        if($student['id'] == $modifierStudent['id']){
            $data['students'][$key] = $modifierStudent;
            jsonToArray($data);
            return true;
        }
    }
    
return false;
}

function modifierFormation($modifierFormation){
    $data = arrayToJson();
    foreach($data['formations'] as $key => $formation){
        if($formation['id'] == $modifierFormation['id']){
            $data['formations'][$key] = $modifierFormation;
            jsonToArray($data);
            return true;
        }
    }
    
return false;
}