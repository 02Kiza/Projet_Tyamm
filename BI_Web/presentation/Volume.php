<?php
require_once '../persistance/dialogueBD.php';

$Volume = DialogueBD::getEvolutionVolumesProduits();
?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Evolution des volumes des produits</title>
    </head>
    <body>
    <h1 style="text-align: center">Evolution des volumes des produits</h1>

    <?php
    foreach ($Volume as $vol) {
        $NomProduit = $vol['NOM_PRODUIT'];
        $prix = $vol['prix'];
        $Vl = $vol['volume'];
        $Date = $vol['mois'];






        echo "<ul style='text-align: center; list-style-type: none;'>";
        echo "<li>  $NomProduit - $prix € - Le volume est $Vl - $Date </li>";
        echo "</ul>";
    }
    ?>
    </body>
    </html>
<?php
