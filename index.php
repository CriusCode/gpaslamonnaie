<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function retrieveTeamById($idEquipe) {
    include('config.php');
    $sql = "SELECT * FROM Equipe WHERE id_equipe = ?";
    $stmt = $mysqlClient->prepare($sql);

    $result_team=$stmt->execute([$idEquipe]);
    return $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G pala monnaie</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .functionality-section {
            display: none; /* Cacher toutes les sections initialement */
        }
    </style>

    <script>
        function showSection(sectionId) {
            // Masquer toutes les sections
            document.querySelectorAll('.functionality-section').forEach(section => {
                section.style.display = 'none';
            });

            // Afficher la section sélectionnée
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
    
</head>
<body>
    <h1>Tournoi de pala de Laressore 2024</h1>
    <!-- Section d'inscription -->
    <div id="inscription" class="functionality-section">
        <?php 
        include ("inscription.php");
        ?>
    </div>

    <!-- Section d'inscription équipe -->
    <div id="inscription-equipe" class="functionality-section">
        <?php 
        include ("inscription-equipe.php");
        ?>
    </div>

    <!-- Section d'inscription -->
    <div id="inscription-tournoi" class="functionality-section">
        <?php 
        include ("inscription-tournoi.php");
        ?>
    </div>

    <!-- Section de commentaires sur le tournoi -->
    <div id="commentaires" class="functionality-section">
        <?php 
        include ("saisie_commentaire.php")
        ?>
    </div>

    <!-- Boutons pour afficher les différentes sections -->
    <button onclick="showSection('inscription')" id='form'>Inscrire un joueur</button>
    <button onclick="showSection('inscription-equipe')" id='equipe'>Enregistrer une nouvelle équipe</button>
    <button onclick="showSection('inscription-tournoi')" id='tournoi'>Créer une nouvelle partie</button>
    

<?php
include 'config.php';

$sql = "SELECT Equipe.nom_equipe, Equipe_Partie.id_equipe_partie, Equipe_Partie.score_equipe1, Equipe_Partie.score_equipe2, Equipe_Partie.id_equipe1, Equipe_Partie.id_equipe2
        FROM Equipe_Partie
        JOIN Equipe ON Equipe_Partie.id_equipe1 = Equipe.id_equipe";  // Utilisation de JOIN pour lier les deux tables

$stmt = $mysqlClient->prepare($sql);

if ($stmt->execute()) {
    $result = $stmt->fetchAll();
    echo '<table>
    <tr>
        <th>Équipe</th>
        <th>Score Équipe 1</th>
        <th>Score Équipe 2</th>
        <th>Action</th>
    </tr>';
    foreach($result as $result_treat) {
        echo '<tr>
        <td>' . retrieveTeamById($result_treat["id_equipe1"])['nom_equipe'] . ' VS ' . retrieveTeamById($result_treat["id_equipe2"])['nom_equipe'] . '</td>
        <td>' . $result_treat["score_equipe1"] . ' ' . (($result_treat["score_equipe1"]==40) ? '🏆' : '') . '</td>
        <td>' . $result_treat["score_equipe2"] . ' ' . (($result_treat["score_equipe2"]==40) ? '🏆' : '') . '</td>
        <td><a href="./enregistrer-score.php?idI=' . $result_treat["id_equipe_partie"] . '">Enregistrer un score</a> | <a href="./comments.php?idI=' . $result_treat["id_equipe_partie"] . '">Laisser / Voir commentaire(s)</a></td>
        </tr>';
    }
    echo '</table>';
} else {
    echo "Erreur dans la requête : " . $stmt->error;
}

?>

<h2>Toutes les équipes enregistrées</h2>
<?php
$sql = "SELECT * FROM Equipe";  // Utilisation de JOIN pour lier les deux tables
$stmt = $mysqlClient->prepare($sql);

if ($stmt->execute()) {
$result = $stmt->fetchAll();
echo '<table>
<tr>
<th>Équipe</th>
<th>Confirmée</th>
<th>Liste de joueurs</th>
</tr>';
foreach($result as $result_treat) {
    echo '<tr>
    <td>' . $result_treat["nom_equipe"] . '</td>
    <td>' . (($result_treat["confirmation_equipe"]==0) ? 'Non' : 'Oui') . '</td>';
    // Récupère tous les joueurs liés à l'équipe
    $sqlPlayers = "SELECT * FROM Joueur WHERE id_equipe=?";
    $stmPlayers = $mysqlClient->prepare($sqlPlayers);
    $allPlayers=$stmPlayers->execute([$result_treat["id_equipe"]]);

    $allPlayers=$stmPlayers->fetchAll();
    if($allPlayers) {
        echo '<td><ul style="padding: 0px 0px 0px 15px;">';
        foreach($allPlayers as $joueur) {
            echo '<li>' . $joueur['prenom_joueur'] . ' ' . $joueur['nom_joueur'] . ' (' . $joueur['mail_joueur'] . ')</li>';
        }
        echo '</ul></td>';
    }
    else {
        echo '<td>Aucun joueur inscrit dans l\'équipe pour le moment</td>';
    }
    echo '</tr>';
}
echo '</table>';
} else {
echo "Erreur dans la requête : " . $stmt->error;
}
?>
</body>
</html>
