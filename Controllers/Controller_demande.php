<?php
class Controller_demande extends Controller
{
    public function action_form_demande()
    {
        $m = Model::getModel();

        if(isset($_POST) && isset($_POST["departement"]) && isset($_POST["examen"]) && isset($_POST["nb_pages"]) && isset($_POST["nb_copies"]) && isset($_POST["typeBrochure"]) && isset($_POST["format"]) && isset($_POST["agrafe"]) && isset($_POST["nb_pages_par_feuille"]) && isset($_POST["date_livraison"]) && isset($_FILES["fichier"])){

            $infos = [
                "utilisateur" => $_SESSION["identifiant"],
                "departement" => $_POST["departement"],
                "examen" => (bool)$_POST["examen"],
                "nb_pages" => $_POST["nb_pages"],
                "nb_copies" => $_POST["nb_copies"],
                "typeBrochure" => $_POST["typeBrochure"],
                "format_feuille" => $_POST["format"],
                "agrafes" => (bool)$_POST["agrafe"],
                "nb_pages_par_copies" => $_POST["nb_pages_par_feuille"],
                "date_demande" => $_POST["date_livraison"],
                "fichier" => $_FILES["fichier"],
                "couverture_couleur" => $_POST["colorDebut"] ?? '',
                "page_fin_couleur" => $_POST["colorFin"] ?? '',
                "type_finition" => $_POST["type_finition"] ?? '',
                "type_perforation" => $_POST["type_perforation"] ?? '',
                "commentaire" => $_POST["commentaire"] ?? ''
            ];

            $m->addNewDemande($infos);

            $this->action_error("Demande envoyée avec succès.");
        }
        $this->action_error("Erreur, veuillez réessayer."); 
    }

    public function action_default()
    {
        $this->action_home();
    }

    public function action_majMonCompte(){

        $m = Model::getModel();

        if(isset($_POST)){
            if(!(isset($_POST["nom"]) && preg_match("/^[A-Za-zÀ-ÿ -]+$/", $_POST["nom"]))){
                $this->action_error("Le nom saisit n'est pas valide.");
                return;
            }
            if(!(isset($_POST["prenom"]) && preg_match("/^[A-Za-zÀ-ÿ -]+$/", $_POST["prenom"]))){
                $this->action_error("Le prénom saisit n'est pas valide.");
            }
            if(!(isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))){
                $this->action_error("Le mail saisit n'est pas valide");
            }
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $id = $_SESSION["identifiant"];

            $m->updateUserInfo($nom, $prenom, $email, $id);

            $this->action_error("Informations modifiées.");
        }
        else{
            $this->action_error("Impossible de ne rien mettre.");
        }
    }

    public function action_update_statut(){

        $m = Model::getModel();

        if(isset($_POST["id_demande"]) && preg_match("/^[0-9]+$/", $_POST["id_demande"]) && isset($_POST["statut"]) && preg_match("/^(En cours|Terminée|Non traitée)$/", $_POST["statut"])){
            $id_demande = $_POST["id_demande"];
            $statut = $_POST["statut"]; 
            $m->updateStatut($id_demande, $statut);
            $this->action_error("Le statut a été modifié");
        }
        else {
            $this->action_error("Il y a eu une erreur. Veuillez réessayer.");
        }
    }

}
?>