<?php require "view_begin.php"; ?>

<?php $infos_compte = $data["informations"];

?>

<section>

    <h1>Informations sur mon compte</h1>
    <form action="?controller=demande&action=majMonCompte" method="POST">
        <input type="hidden" name="controller" value="demande">
        <input type="hidden" name="action" value="majMonCompte">
        <div>
            <label for="nom">Nom</label>
            <input type="text" placeholder="Nouveau nom" name="nom" value="<?=htmlspecialchars($infos_compte["nom"]);?>">
        </div>

        <div>
            <label for="prenom">Prénom</label>
            <input type="text" placeholder="Nouveau prénom" name="prenom" value="<?=$infos_compte["prenom"];?>">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" placeholder="Nouveau mail" name="email" value="<?=$infos_compte["email"];?>">
        </div>

        <div>
            <label for="numTel">Numéro de téléphone</label>
            <input type="text" placeholder="Nouveau numéro de téléphone" name="numTel" value="<?=$infos_compte["numTel"] ;?>">
        </div>

        <button class="button">Modifier les informations</button>
    </form>
</section>

<?php require "view_end.php"; ?>