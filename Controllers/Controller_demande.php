<?php
class Controller_demande extends Controller
{
    public function action_form_demande()
    {
        $m = Model::getModel();

        if(isset($_POST) && isset($_POST[""]))
        $this->render("message", $data);
    }

    public function action_default()
    {
        $this->action_home();
    }
}
?>