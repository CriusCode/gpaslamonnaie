<?php
// Exemple d'insertion
$equipe1 = "Nom Equipe 1";
$equipe2 = "Nom Equipe 2";
$score1 = 2;
$score2 = 3;

$sql = "INSERT INTO Equipe_Partie (id_equipe1, id_equipe2, score_equipe1, score_equipe2) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param("iiss", $equipe1, $equipe2, $score1, $score2);

if ($stmt->execute()) {
    echo "Insertion réussie.";
} else {
    echo "Erreur lors de l'insertion : " . $stmt->error;
}

$stmt->close();
$conn->close();
?> 