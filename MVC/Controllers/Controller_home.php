<?php

class Controller_home extends Controller
{
    public function action_home()
    {
        $m = Model::getModel();

        $affiliation = $_SESSION["eduPersonPrimaryAffiliation"];
        $id = $_SESSION["identifiant"];

        if($affiliation == "responsable"){
            $data = [
                "resp_info" => $m->getUserInfo($id),
                "resp_demande_en_att" => $m->getDemandeNonTerminee()
            ];
            $this->render("home_responsable", $data);
            return;
        }
        else{
            $data = [
                "ens_info" => $m->getUserInfo($id),
                "ens_demande" => $m->getDemandeForEns($id)
            ];
            $this->render("home_enseignant", $data);
            return;
        }
    }

    public function action_default()
    {
        $this->action_home();
    }
}
?>