<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de reprographie de l'IUT de Villetaneuse</title>
    <link rel="stylesheet" href="Content/CSS/styles.css">
</head>
<body>
    <header>
        <div>
            <a href="index.php"><img src="Content/img/logo_iutv_bleu.jpeg" alt="Logo IUTV"></a>
            <nav>
                <a href="?controller=list&action=monCompte"><?= $_SESSION["identifiant"] ?? 'Mon Compte';?></a>
                <?php 

                    if($_SESSION["eduPersonPrimaryAffiliation"] === "responsable"){
                        echo "<a href='?controller=list'>Tableau de bord</a>";
                        echo "<a href='?controller=list&action=historique'>Historique</a>";
                    }
                    else{
                        echo "<a href='?controller=formRequest'>Nouvelle demande</a>";
                    }

                ?>
            </nav>
        </div>
    </header>