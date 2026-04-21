<?php 
function validerEmail($email){
    $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if(preg_match($pattern, $email)) {
    return true;
    } else {
    return false;
    }
}

function uniciteEmail($email){
    $data = arrayToJson();
    foreach($data['students'] as $student){
        if($student['email'] == $email){
            return false;
        }
    }
    return true;
}
