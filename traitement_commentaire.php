<?php
// Assurez-vous d'avoir une instance PDO
require_once 'db_connect.php';

// Assurez-vous que votre formulaire a un champ nommé 'commentaire'
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le commentaire du formulaire
    $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';

    // Validation des données (vous pouvez ajouter d'autres vérifications)
    if (empty($commentaire)) {
        echo "Le commentaire ne peut pas être vide.";
    } else {
        // Préparer la requête SQL
        $sql = "INSERT INTO commentaire (commentaire) VALUES (:commentaire)";
        $stmt = $pdo->prepare($sql);

        // Liage des paramètres
        $stmt->bindParam(':commentaire', $commentaire);

        // Exécution de la requête
        if ($stmt->execute()) {
            echo "Le commentaire a été ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout du commentaire : " . implode(", ", $stmt->errorInfo());
        }
    }
}
?>
