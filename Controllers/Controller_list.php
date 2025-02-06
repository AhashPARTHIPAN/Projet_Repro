<?php

class Controller_list extends Controller
{
    public function action_dashboard()
    {
        $m = Model::getModel();
        $data = [
            "etat_demandes" => $m->getEtatDemandes(),
            "stats_par_departement" => $m->getStatsParDepartement()
        ];
        $this->render("tableau_de_bord", $data);
    }

    public function action_default()
    {
        $this->action_dashboard();
    }

    public function action_historique(){
        $m = Model::getModel();
        $data = [
            "demande_anciennes" => $m->getDemandeParStatus("Terminée")
        ];  
        $this->render("historique", $data);
    }

    public function action_detailsDemande(){
        $m = Model::getModel();
        if(isset($_GET["id_demande"]) && preg_match("/^[1-9]\d*$/", $_GET["id_demande"])){
            $data = [
                "details_demande" => $m->getDetailsDemandeById($_GET["id_demande"])
            ];
        }
        if($data["details_demande"] == []){
            $this->action_error("Pas de demande avec cette identifiant.");

        }
        else {
            $this->render("details_demande", $data);
        }
    }

    public function action_infos_departement(){
        $m = Model::getModel();
        if(isset($_GET["nom_dept"]) && preg_match("/^[a-zA-Z]*$/", $_GET["nom_dept"])){
            $data = [
                "details_departement" => $m->getDetailsDepartement($_GET["nom_dept"])
            ];
        }
        if($data["details_departement"] == []){
            $this->action_error("Pas de département avec ce nom.");
        }
        else{
            $this->render("details_departement", $data);
        }
    }

}
?>