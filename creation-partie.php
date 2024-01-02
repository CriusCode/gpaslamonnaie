<?php
include 'config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['premiere_equipe']) && isset($_POST['deuxieme_equipe'])) {
        if($_POST['premiere_equipe'] != $_POST['deuxieme_equipe']) {
            $id_equipe_one = $_POST['premiere_equipe'];
            $id_equipe_two = $_POST['deuxieme_equipe'];

            $sql = "INSERT INTO Equipe_Partie (id_equipe1, id_equipe2, score_equipe1, score_equipe2) 
                    VALUES (?, ?, 0, 0)";
            $stmt = $mysqlClient->prepare($sql);
        
            $result_inscription=$stmt->execute([$id_equipe_one, $id_equipe_two]);
        
        
            if ($result_inscription) {
                echo "La partie vient d'être créée !"; 
                echo "<p><a href='index.php'><button>Revenir au classement</button></a></p>";
            } else {
                echo "Erreur lors de la création de la partie : " . $stmt->error;
            }
        } 
        else {
            echo "<p>Vous ne pouvez pas faire affronter une équipe contre elle même";
        }
    }

} else {
    echo "Méthode non autorisée.";
}
?>
