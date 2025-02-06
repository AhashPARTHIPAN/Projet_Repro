<?php 
    require "view_begin_responsable.php";
    $details_departement = $data["details_departement"];    
?>

<section>
    <h1>Informations sur le département : <?= $details_departement[0]["Dept"];?></h1>
    <table>
        <tr> <th>Nom, prénom</th> <th>Nb de demandes</th> <th>Total de pages</th> <th>Total de copies</th></tr>
        <?php foreach ($details_departement as $details_ens): ?>
            <tr>
                <td><?= $details_ens["nom"] . " " . $details_ens["prenom"]; ?></td>
                <td><?= $details_ens["Nb_de_demandes"]; ?></td>
                <td><?= $details_ens["Total_nb_de_pages"]; ?></td>
                <td><?= $details_ens["Total_nb_de_copies"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<?php require "view_end_responsable.php" ;?>