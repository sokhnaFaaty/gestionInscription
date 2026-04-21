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
function menuStudent(){
    while(true){
        echo "\n============================================\n";
        echo "        GESTION DES ÉTUDIANTS\n";
        echo "============================================\n";
        echo "1. Ajouter un étudiant\n";
        echo "2. Modifier un étudiant\n";
        echo "3. Supprimer un étudiant\n";
        echo "4. Lister tous les étudiants\n";
        echo "5. Retour\n";
        echo "============================================\n";
        
        $choix = readline("Votre choix : ");
        
        switch($choix){
            case 1:
                $nouvelStudent = saisieStudent();
                if($nouvelStudent){
                    ajouterStudent($nouvelStudent);
                }
                break;
            case 2:
                $id = (int)readline("ID de l'étudiant à modifier : ");
                $student = getStudentById($id);
                if($student){
                    // echo "Nouvelles valeurs (laisser vide pour conserver) :\n";
                    $nom = readline("Nom ({$student['nom']}) : ");
                    $prenom = readline("Prénom ({$student['prenom']}) : ");
                    $email = readline("Email ({$student['email']}) : ");
                    
                    $studentModifie = [
                        'id' => $id,
                        'nom' => !empty($nom) ? $nom : $student['nom'],
                        'prenom' => !empty($prenom) ? $prenom : $student['prenom'],
                        'email' => !empty($email) ? $email : $student['email']
                    ];
                    
                    if(modifierStudent($studentModifie)){
                        echo "Étudiant modifié !\n";
                    } else {
                        echo "Erreur lors de la modification !\n";
                    }
                } else {
                    echo "Étudiant non trouvé !\n";
                }
                break;
            case 3:
                $id = (int)readline("ID de l'étudiant à supprimer : ");
                $student = getStudentById($id);
                if($student){
                    echo "Étudiant : " . $student['prenom'] . " " . $student['nom'] . "\n";
                    $confirmation = readline("Confirmer la suppression (o/N) : ");
                    if(strtolower($confirmation) == 'o'){
                        if(deleteStudent($id)){
                            echo "Étudiant supprimé !\n";
                        } else {
                            echo "Erreur lors de la suppression !\n";
                        }
                    } else {
                        echo "Suppression annulée.\n";
                    }
                } else {
                    echo "Étudiant non trouvé !\n";
                }
                break;
            case 4:
                $students = getAllStudents();
                afficherTousLesStudents($students);
                break;
            case 5:
                echo "Retour au menu principal...\n";
                return;
            default:
                echo "Choix invalide !\n";
        }
    }
}
function menuPrincipal(){
    echo "\n========================================\n";
    echo "   GESTION DES INSCRIPTIONS - ÉCOLE 221\n";
    echo "========================================\n";
    echo "1. Gestion des étudiants\n";
    echo "2. Gestion des formations\n";
    echo "3. Quitter\n";
    echo "========================================\n";
}
function afficherUnStudent($student){
    echo "===================================\n";
    echo "Nom : " . $student['nom']." \n";
    echo "Prénom : " . $student['prenom'] . "\n";
    echo "Email : " . $student['email'] . "\n";
    echo "===================================\n";
}

function afficherTousLesStudents($students){
    foreach($students as $student){
        afficherUnStudent($student);
    }
}

function afficherUneFormation($formation){
    echo "===================================\n";
    echo "Titre : " . $formation['titre']." \n";
    echo "Description : " . $formation['description'] . "\n";
    echo "===================================\n";
}

function afficherToutesLesFormations($formations){
    foreach($formations as $formation){
        afficherUneFormation($formation);
    }
}
