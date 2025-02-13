<?php

class Controller_home_resp extends Controller
{
    public function action_home()
    {
        $m = Model::getModel();
        $id = $_SESSION["identifiant"];
        $statut = "En cours";
        $data = [
            "resp_info" => $m->getUserInfo($id),
            "resp_demande_en_att" => $m->getDemandeNonTerminee()
        ];
        $this->render("home_responsable", $data);
    }

    public function action_default()
    {
        $this->action_home();
    }
}
?>