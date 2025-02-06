<?php 
    require "view_begin_responsable.php" ;
    $details = $data["details_demande"];
?>

<section>
    <h1>Détails de la demande</h1>
    <div class="details_demande">
        <b>Département : </b><?=$details["Dept"];?><br>
        <b>NOM Prénom: </b><?=strtoupper($details["nom"]) . " " . $details["prenom"];?><br>
        <b>Nb de pages : </b><?=$details["nb_pages"];?><br>
        <b>Nb de copies : </b><?=$details["nb_copies"];?><br>
        <b>Agrafes : </b><?php if($details["agrafes"] == true){echo "Oui";} else{echo "Non";}?><br>
        <b>Type : </b><?=$details["nomBrochure"];?><br>
        <b>Date : </b><?=$details["date_demande"];?><br>
        <b>Status : </b><span class="status"><?=$details["status"];?></span><br>
        <b>Commentaire : </b><?=$details["commentaire"];?><br>
        <b>Fichier : </b><?=$details["fichier"];?><br>
    </div>
</section>

<script src="ScriptJS/script_changeColor.js"></script>

<?php require "view_end_responsable.php" ;?>