<?php
require_once '../persistance/dialogueBD.php';

$db = new DialogueBD();
try {
    $applications10 = $db->getTop10ApplicationsByGrandClient();
} catch (Exception $e) {
    $erreur = $e->getMessage();

}

// AFFICHAGE
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Top 10 des Applications</title>
</head>
<body>
    <h1 style="text-align: center">Voici le top 10 des applications par grand client en € </h1>

        <body>
        <body>
        <ul>
            <?php
            $num = 1;

            foreach ($applications10 as $application) { ?>
                <ul style="text-align: center">
                    <?php echo "Rang: " . $num . " - " .($application['nomAppli'])."  Nom du Grand Client :  "  . ($application['NomGrandClient'])."    Prix : "  . ($application['total_prix']. "€"); ?>
                </ul>
                <?php
                $num++;
            } ?>
        </ul>
        </body>

        </body>
</body>
</html>

