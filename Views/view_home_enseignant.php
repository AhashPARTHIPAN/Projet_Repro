<?php include "view_begin_enseignant.php"; ?>

<section>
    <h1>Demandes en cours</h1>

    <table>
        <tr> <th>Dept.</th> <th>Nb. pages</th> <th>Nb. copies</th> <th>Agrafe</th> <th>Types</th> <th>Date de livraison</th> <th>Status</th></tr>
        <?php foreach ($data["ens_demande"] as $demande): ?>
            <tr>
                <td><?= $demande["nom"]; ?></td>
                <td><?= $demande["nb_pages"]; ?></td>
                <td><?= $demande["nb_copies"]; ?></td>
                <td><?php if($demande["agrafes"] === true){echo "Oui";} else{echo "Non";}?></td>
                <td><?= $demande["nomBrochure"]; ?></td>
                <td><?= $demande["date_demande"]; ?></td>
                <td class="status"><?= $demande["status"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<script src="ScriptJS/script_changeColor.js"></script>

<?php include "view_end.php"; ?>