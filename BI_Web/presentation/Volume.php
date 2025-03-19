<?php
require_once '../persistance/dialogueBD.php';
echo "<h1>Évolution des Volumes des Produits</h1>";

echo "<table>";
echo "<thead><tr><th>Produit</th><th>Mois</th><th>Volume</th><th>Prix (€)</th></tr></thead>";
echo "<tbody>";

$data = DialogueBD::getEvolutionVolumesProduits();
foreach ($data as $vol) {
    echo "<tr>";
    echo "<td>" . ($vol['NOM_PRODUIT']) . "</td>";
    echo "<td>" . ($vol['mois']) . "</td>";
    echo "<td>" . number_format($vol['volume'], 0, ',', ' ') . "</td>";
    echo "<td>" . number_format($vol['prix'], 2, ',', ' ') . "</td>";
    echo "</tr>";
}
echo "</tbody></table>";
?>
<p style="text-align: center"><a href ="Accueil.php">Accueil</a></p>

<style>

    a {
        text-decoration: none;
        color: red;
        font-weight: bold;
    }

    a:hover {
        color: black;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        text-align: center;
        padding: 20px;
    }

    h1 {
        background-color: black;
        color: white;
        padding: 15px;
        border-bottom: 3px solid red;
        display: inline-block;
        margin-bottom: 20px;
    }

    table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
        background: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px;
        border: 1px solid black;
        text-align: center;
    }

    th {
        background-color: red;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #ddd;
    }
</style>
