<?php
require_once '../persistance/dialogueBD.php';

$grandClients = DialogueBD::getAllGrandClients();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" href="design.css" />
    <title>Top 10 des Applications</title>
</head>
<body>
<h1 style="text-align: center">Top 10 des applications par grand client en €</h1>

<?php
foreach ($grandClients as $client) {
    $grandClientID = $client['GrandClientID'];
    $nomGrandClient = ($client['NomGrandClient']);

    $topApps = DialogueBD::getTop10ApplicationsByGrandClient($grandClientID);

    echo "<h2 style='text-align: center'>$nomGrandClient</h2>";
    echo "<ul style='text-align: center; list-style-type: none;'>";

    $num = 1;
    foreach ($topApps as $app) {
        $nomAppli = ($app['nomAppli']);
        $prix = number_format($app['prix'] / 100, 2, ',', ' '); // c'était pour éviter les centimes dans lcode

        echo "<li>Rang $num : $nomAppli - $prix €</li>";
        $num++;
    }

    echo "</ul>";
}
?>

<p style="text-align: center"><a href ="Accueil.php">Accueil</a></p>
</body>
</html>
