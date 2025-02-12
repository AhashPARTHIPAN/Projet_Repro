<?php

session_destroy();
session_start();

require_once "Models/Model.php";

require_once "Controllers/Controller.php";

$controllers = ["home_user", "home_resp", "formRequest", "list", "demande"];

$controller_default = "home";

$_SESSION['identifiant'] = 7;
$_SESSION['eduPersonPrimaryAffiliation'] = "stu"; //10% livre ou partition musicale // 30% journal ou un périodique.

//On teste si le paramètre controller existe et correspond à un contrôleur de la liste $controllers
if (isset($_GET['controller']) and in_array($_GET['controller'], $controllers)) {
    $nom_controller = $_GET['controller'];
} else {
    // On regarde qui est l'utilisateur
    if($_SESSION["eduPersonPrimaryAffiliation"] === "responsable"){
        $nom_controller = "home_resp";
    }
    else{
        $nom_controller = $controller_default;
    }
}

//On détermine le nom de la classe du contrôleur
$nom_classe = 'Controller_' . $nom_controller;

//On détermine le nom du fichier contenant la définition du contrôleur
$nom_fichier = 'Controllers/' . $nom_classe . '.php';



//Si le fichier existe et est accessible en lecture
if (is_readable($nom_fichier)) {
    //On l'inclut et on instancie un objet de cette classe
    include_once $nom_fichier;
    new $nom_classe();
} else {
    echo $nom_fichier;
    die("Error 404: not found!");
}







// RAJOUTER NUM TEL DANS BDD + modif la page MonCompte
// DATE DE TRANSMISSION DU DOC.