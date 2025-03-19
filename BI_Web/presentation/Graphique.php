<?php
// Inclure la classe DialogueBd
include_once '../persistance/DialogueBd.php';

// Récupérer les données des 5 plus grands clients
$data = DialogueBd::getEvolutionGrandClient();

// Si des données sont récupérées
if (!empty($data)) {
    $json_data = json_encode($data);
} else {
    $json_data = json_encode([]);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évolution des Montants des 5 Plus Grands Clients</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-3d"></script>
</head>
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
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .chart-container {
        width: 80%;
        height: 60%;
        max-width: 800px; /* Limite de taille */
        margin: auto;
    }
</style>
<body>
<h2>Évolution des montants des 5 plus grands clients (Jan 2021 - Avr 2022)<p style="text-align: center"><a href ="Accueil.php">Accueil</a></p></h2>
<div class="chart-container">
    <canvas id="chart3D"></canvas>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let data = <?php echo $json_data; ?>;

        // Extraire les clients et mois
        let clients = [...new Set(data.map(item => item.NomClient))];
        let mois = [...new Set(data.map(item => item.mois))].sort();

        // Générer un dataset pour chaque client
        let datasets = clients.map(client => {
            return {
                label: client,
                data: mois.map(m => {
                    let vente = data.find(item => item.NomClient === client && item.mois === m);
                    return vente ? vente.montant_total : 0;
                }),
                backgroundColor: getRandomColor(),
                borderColor: "#000",
                borderWidth: 1
            };
        });

        // Générer des couleurs aléatoires
        function getRandomColor() {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.8)`;
        }

        // Création du graphique 3D avec Chart.js
        const ctx = document.getElementById("chart3D").getContext("2d");
        new Chart(ctx, {
            type: "line",
            data: {
                labels: mois,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: "top" }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
</body>
</html>
