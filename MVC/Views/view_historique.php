<?php require "view_begin.php" ;?>

<section>
    <h1>Historique des demandes</h1>

    <table>
        <tr> <th>Dept.</th> <th>Nom</th> <th>Prénom</th> <th>Nb. pages</th> <th>Nb. copies</th> <th>Agrafe</th> <th>Types</th> <th>Date de livraison</th> <th>Statut</th></tr>
        <?php foreach ($data["demande_anciennes"] as $demande_terminee): ?>
            <tr>
                <td><?= $demande_terminee["Dept"]; ?></td>
                <td><?= $demande_terminee["nom"]; ?></td>
                <td><?= $demande_terminee["prenom"]; ?></td>
                <td><?= $demande_terminee["nb_pages"]; ?></td>
                <td><?= $demande_terminee["nb_copies"]; ?></td>
                <td><?php if($demande_terminee["agrafes"] == true){echo "Oui";} else{echo "Non";}?></td>
                <td><?= $demande_terminee["nomBrochure"]; ?></td>
                <td><?= $demande_terminee["date_demande"]; ?></td>
                <td class="statut"><?= $demande_terminee["statut"]; ?></td>
                <td><a href="?controller=list&action=detailsDemande&id_demande=<?= $demande_terminee["id_demande"];?>" class="button">Voir plus</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<script src="ScriptJS/script_changeColor.js"></script>

<?php require "view_end_responsable.php" ;?>