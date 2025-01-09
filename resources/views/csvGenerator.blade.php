<?php
// Données du tableau
$data = [
    ["ID", "Nom", "Prénom", "Email"],
    [1, "Dupont", "Jean", "jean.dupont@example.com"],
    [2, "Durand", "Marie", "marie.durand@example.com"],
    [3, "Martin", "Paul", "paul.martin@example.com"]
];

// Fonction pour générer et télécharger le fichier CSV
if (isset($_POST['download_csv'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="tableau.csv"');

    $output = fopen('php://output', 'w');
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau avec téléchargement CSV</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- Affichage du tableau -->
    <table>
        <thead>
            <tr>
                <?php foreach ($data[0] as $header): ?>
                    <th><?= htmlspecialchars($header) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i < count($data); $i++): ?>
                <tr>
                    <?php foreach ($data[$i] as $cell): ?>
                        <td><?= htmlspecialchars($cell) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <!-- Bouton pour télécharger le CSV -->
    <form method="post">
        <button type="submit" name="download_csv">Télécharger en CSV</button>
    </form>
</body>
</html>