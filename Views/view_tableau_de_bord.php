<?php include "view_begin_responsable.php"; ?>

<section>

    <h1>Tableau de bord</h1>
    <p>
        Demandes traitées : <?= $data["etat_demandes"][2]["total_demandes"];?>
        Demandes non traitées : <?= $data["etat_demandes"][1]["total_demandes"];?>
        Demandes en cours : <?= $data["etat_demandes"][0]["total_demandes"];?>
    </p>

    <p><input type="number" placeholder="Entrer une année (ex: 2020, 2021 ...)"></p>

    <table>
        <tr> <th>Dept.</th> <th>Total pages</th> <th>Total copies</th> <th>Total demande</th></tr>
        <?php foreach ($data["stats_par_departement"] as $demande_en_att): ?>
            <tr>
                <td><a href="?controller=list&action=infos_departement&nom_dept=<?= $demande_en_att["nom"] ;?>"><?= $demande_en_att["nom"] ;?></a></td>
                <td><?= $demande_en_att["total_nb_pages"]; ?></td>
                <td><?= $demande_en_att["total_nb_copies"]; ?></td>
                <td><?= $demande_en_att["total_demande"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<?php include "view_end.php"; ?>