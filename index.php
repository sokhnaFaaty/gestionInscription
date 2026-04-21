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
function deleteStudent($id){
    $data = arrayToJson();
    foreach($data['students'] as $key => $student){
        if($student['id'] == $id){
            unset($data['students'][$key]);
            $data['students'] = array_values($data['students']);
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

function deleteFormation($id){
    $data = arrayToJson();
    foreach($data['formations'] as $key => $formation){
        if($formation['id'] == $id){
            unset($data['formations'][$key]);
            $data['formations'] = array_values($data['formations']);
    
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
    
return false;
}
unction saisieStudent(){
    $nom = readline("Entrez le nom de l'etudiant : ");
    $prenom = readline("Entrez le prenom de l'etudiant : ");
    $email = readline("Entrez l'email de l'etudiant : ");
   if(!validerEmail($email)){
        echo "Email non valide \n";
        return null;
    }
    if(!uniciteEmail($email)){
        echo "Cet email existe déjà \n";
        return null;
    }
    
    $id = count(getAllStudents()) + 1;
    return [
        'id' => $id,
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email
    ];

}
function ajouterStudent($newStudent){
    $data = arrayToJson();
    $data['students'][] = $newStudent;
    jsonToArray($data);
}

function saisieFormation(){
    $titre = readline("Entrez le titre de la formation : ");
    $description = readline("Entrez la description de la formation : ");

    $id = count(getAllFormations()) + 1;
    return [
        'id' => $id,
        'titre' => $titre,
        'description' => $description
    ];
   

}

function ajouterFormation($newformation){
    $data = arrayToJson();
    $data['formations'][] = $newformation;
    jsonToArray($data);
}
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
