<?php

class Controller_home extends Controller
{
    public function action_home()
    {
        $m = Model::getModel();

        if(isset($_SESSION) && isset($_SESSION["eduPersonPrimaryAffiliation"]) && isset($_SESSION["identifiant"])){
            $id = $_SESSION["identifiant"];
            $affiliation = $_SESSION["eduPersonPrimaryAffiliation"];
        }
        else{
            $this->action_error("Aucun utilisateur défini.");
        }

        if($affiliation === "responsable"){
            
            $status = "En attente";
            $data = [
                "resp_info" => $m->getUserInfo($id),
                "resp_demande_en_att" => $m->getDemandeParStatus($status)
            ];
            $this->render("home_responsable", $data);
        }
        else{
            $data = [
                "ens_info" => $m->getUserInfo($id),
                "ens_demande" => $m->getDemandeForEns($id)
            ];
            $this->render("home_enseignant", $data);
        }
    }

    public function action_default()
    {
        $this->action_home();
    }
}
?>