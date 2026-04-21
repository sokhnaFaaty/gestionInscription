<?php
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