<?php include "view_begin_responsable.php"; ?>

<section>

    <h1>Demandes d'impressions en attente</h1>

    <div>
        <p>
            <input type="text" placeholder="Rechercher une demande">
        </p>
    </div>

    <table>
        <tr> <th>Dept.</th> <th>NOM Prénom</th> <th>Nb. pages</th> <th>Nb. copies</th> <th>Agrafe</th> <th>Types</th> <th>Date de livraison</th> <th>Status</th></tr>
        <?php foreach ($data["resp_demande_en_att"] as $demande_en_att): ?>
            <tr>
                <td><?= $demande_en_att["Dept"]; ?></td>
                <td><?= strtoupper($demande_en_att["nom"]) . " " . $demande_en_att["prenom"]; ?></td>
                <td><?= $demande_en_att["nb_pages"]; ?></td>
                <td><?= $demande_en_att["nb_copies"]; ?></td>
                <td><?php if($demande_en_att["agrafes"] == true){echo "Oui";} else{echo "Non";}?></td>
                <td><?= $demande_en_att["nomBrochure"]; ?></td>
                <td><?= $demande_en_att["date_demande"]; ?></td>
                <td class="status"><?= $demande_en_att["status"]; ?></td>
                <td><a href="?controller=list&action=detailsDemande&id_demande=<?= $demande_en_att["id_demande"];?>">Voir plus</a></td>

            </tr>
        <?php endforeach; ?>
    </table>
</section>

<script src="ScriptJS/script_changeColor.js"></script>

<?php include "view_end.php"; ?>