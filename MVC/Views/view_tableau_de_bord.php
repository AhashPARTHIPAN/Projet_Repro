<?php include "view_begin.php"; ?>

<section>

    <?php 
    
        if(isset($_GET["annee"]) && preg_match("/^[1-9]\d*$/", $_GET["annee"])){
            echo "<h1>Tableau de bord (" . $_GET["annee"] . ")" ."</h1>";
        }
        else{
            echo "<h1>Tableau de bord</h1>";
        }

        $etat_demande = $data["etat_demandes"][0];

    ;?>

    <p>
        <b>Demandes traitées :</b> <?= $etat_demande["Terminée"]; ?>&nbsp
        <b>Demandes en cours :</b> <?= $etat_demande["En cours"]; ?>&nbsp
        <b>Demandes non traitées :</b> <?= $etat_demande["Non traitée"]; ?>
        <br>
        <br>
    </p>

    <form action="" method="GET">
        <input type="hidden" name="controller" value="list">
        <input type="hidden" name="action" value="dashboard">
        <input type="number" name="annee" placeholder="Entrer une année (ex: 2020, 2021 ...)">
    </form>

    
    <table>
        <tr> <th>Dept.</th> <th>Total pages</th> <th>Total copies</th> <th>Total demande</th></tr>
        <?php foreach ($data["stats_par_departement"] as $demande_en_att): ?>
            <tr>
                <td class="dept_stat"><a href="?controller=list&action=infos_departement&nom_dept=<?= $demande_en_att["nom"] ;?>"><?= $demande_en_att["nom"] ;?></a></td>
                <td><?= $demande_en_att["total_nb_pages"]; ?></td>
                <td><?= $demande_en_att["total_nb_copies"]; ?></td>
                <td><?= $demande_en_att["total_demande"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<?php include "view_end.php"; ?>