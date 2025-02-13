<?php

class Controller_home_user extends Controller
{
    public function action_home()
    {
        $m = Model::getModel();
        $id = $_SESSION["identifiant"];
        $data = [
            "ens_info" => $m->getUserInfo($id),
            "ens_demande" => $m->getDemandeForEns($id)
        ];
        $this->render("home_enseignant", $data);
    }

    public function action_default()
    {
        $this->action_home();
    }
}
?>