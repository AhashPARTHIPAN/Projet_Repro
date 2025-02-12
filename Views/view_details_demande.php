<?php 
    require "view_begin.php" ;
    $details = $data["details_demande"];

    function estVide($str){
        if($str == '' || $str === "#000000"){
            return "-";
        }
        else if (preg_match('/^#/', $str)){
            return "<input type='color' name='color' id='color' value='" . htmlspecialchars($str) . "' class='radio-flex' style='height: 25px; padding: 1px;' disabled>". " " . strtoupper($str);
        }
        return htmlspecialchars($str);
    }

    function printIfColor($str){
        if($str !== "#000000"){
            return "-";
        }
        else {
            return $str;
        }
    }

?>

<section>
    <h1>Détails de la demande</h1>
    <div class="details_demande">
        <b>Département : </b><?=htmlspecialchars($details["Dept"]);?><br>
        <b>NOM Prénom: </b><?=htmlspecialchars(strtoupper($details["nom"]) . " " . $details["prenom"]);?><br>
        <b>Nb de pages : </b><?=htmlspecialchars($details["nb_pages"]);?><br>
        <b>Nb de copies : </b><?=htmlspecialchars($details["nb_copies"]);?><br>
        <b>Format : </b><?=htmlspecialchars($details["format_feuille"]);?><br>
        <b>Agrafes : </b><?php if($details["agrafes"] == true){echo "Oui";} else{echo "Non";}?><br>
        <b>Type : </b><?=htmlspecialchars($details["nomBrochure"]);?><br>
        <b>Couverture couleur : </b><?= estVide($details["couverture_couleur"]);?><br>
        <b>Couverture de fin couleur : </b><?= estVide($details["page_fin_couleur"]);?><br>
        <b>Type de finition : </b><?=estVide($details["type_finition"]);?><br>
        <b>Type perforation : </b><?= estVide($details["type_perforation"]);?><br>
        <b>Date : </b><?=htmlspecialchars($details["date_demande"]);?><br>

        <b>Statut : </b><span class="statut"><?=htmlspecialchars($details["statut"]);?></span>
        <form action="?controller=demande&action=update_statut" id="choix_statut_form" class="radio-flex" method="POST">
            <input type="hidden" name="id_demande" value=<?=$_GET["id_demande"];?>>
            <select name="statut" id="choix_statut">
                <option value="En cours">En cours</option>
                <option value="Terminée">Terminée</option>
                <option value="Non traitée">Non traitée</option>
            </select>&nbsp
            <button class="button">Valider</button>
        </form>

        <b>Commentaire : </b><?= estVide($details["commentaire"]);?><br>
        <b>Fichier : </b><?=htmlspecialchars($details["fichier"]);?><br>
    </div>
</section>

<script src="ScriptJS/script_changeColor.js"></script>

<?php require "view_end_responsable.php" ;?>