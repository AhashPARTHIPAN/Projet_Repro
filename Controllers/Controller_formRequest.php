<?php
class Controller_formRequest extends Controller
{
    public function action_home()
    {
        $m = Model::getModel();
        $data = [
            "departements" => $m->getDepartements(),
            "typesBrochures" => $m->getTypesBrochures()
        ];
        $this->render("formRequest", $data);
    }

    public function action_default()
    {
        $this->action_home();
    }
}
?>