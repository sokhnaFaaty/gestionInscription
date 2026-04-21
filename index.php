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
    
return false;
}
function saisieStudent(){
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


function arrayToJson(){
    $json = file_get_contents('data.json');
    $data = json_decode($json, true);
    return $data;
}

function jsonToArray($data){
    $json = json_encode($data);
    file_put_contents('data.json', $json);
}
function menuFormation(){
    while(true){
        echo "\n===============================================\n";
        echo "        GESTION DES FORMATIONS\n";
        echo "===============================================\n";
        echo "1. Ajouter une formation\n";
        echo "2. Modifier une formation\n";
        echo "3. Supprimer une formation\n";
        echo "4. Lister toutes les formations\n";
        echo "5. Retour\n";
        echo "===============================================\n";
        
        $choix = readline("Votre choix : ");
        
        switch($choix){
            case 1:
                $nouvelleFormation = saisieFormation();
                if($nouvelleFormation){
                    ajouterFormation($nouvelleFormation);
                }
                break;
            case 2:
                $id = (int)readline("ID de la formation à modifier : ");
                $formation = getFormationById($id);
                if($formation){
                    echo "Nouvelles valeurs (laisser vide pour conserver) :\n";
                    $titre = readline("Titre ({$formation['titre']}) : ");
                    $description = readline("Description ({$formation['description']}) : ");
                    
                    $formationModifiee = [
                        'id' => $id,
                        'titre' => !empty($titre) ? $titre : $formation['titre'],
                        'description' => !empty($description) ? $description : $formation['description']
                    ];
                    
                    if(modifierFormation($formationModifiee)){
                        echo "Formation modifiée !\n";
                    } else {
                        echo "Erreur lors de la modification !\n";
                    }
                } else {
                    echo "Formation non trouvée !\n";
                }
                break;
            case 3:
                $id = (int)readline("ID de la formation à supprimer : ");
                $formation = getFormationById($id);
                if($formation){
                    echo "Formation : " . $formation['titre'] . "\n";
                    $confirmation = readline("Confirmer la suppression (o/N) : ");
                    if(strtolower($confirmation) == 'o'){
                        if(deleteFormation($id)){
                            echo "Formation supprimée !\n";
                        } else {
                            echo "Erreur lors de la suppression !\n";
                        }
                    } else {
                        echo "Suppression annulée.\n";
                    }
                } else {
                    echo "Formation non trouvée !\n";
                }
                break;
            case 4:
                $formations = getAllFormations();
                afficherToutesLesFormations($formations);
                break;
            case 5:
                echo "Retour au menu principal...\n";
                return;
            default:
                echo "Choix invalide !\n";
        }
    }
}


if(!file_exists('data.json')){
    $initData = ['students' => [], 'formations' => []];
    file_put_contents('data.json', json_encode($initData, JSON_PRETTY_PRINT));
}

// Menu principal
do{
    menuPrincipal();
    $choix = readline("Votre choix : ");
    switch($choix){
        case 1:
            menuStudent();
            break;
        case 2:
            menuFormation();
            break;
        case 3:
            echo "Au revoir !\n";
            exit(0);
        default:
            echo "Choix invalide ! Veuillez entrer 1, 2 ou 3.\n";
    }
} while(true);

