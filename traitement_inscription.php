<?php
include 'config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// array(6) { ["prenom_joueur"]=> string(7) "fgdfdfv" ["nom_joueur"]=> string(1) "d" ["nom_equipe"]=> string(4) "fdfv" ["telephone"]=> string(3) "dvf" ["email"]=> string(31) "jeanthomas.muller2609@gmail.com" ["certificat_aptitude"]=> string(4) "dfdf" }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['register-equipe'])) {
        $id_equipe = $_POST['nom_equipe'];
        $telephone_joueur = $_POST['telephone_joueur'];
        $email_joueur = $_POST['email_joueur'];
        $certificat_medical = $_POST['certificat_medical'];
        $prenom_joueur = $_POST['prenom_joueur'];
        $nom_joueur = $_POST['nom_joueur'];
    
        $sql = "INSERT INTO Joueur (prenom_joueur, nom_joueur, id_equipe, telephone_joueur, mail_joueur, certificat_medical) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqlClient->prepare($sql);
    
        $result_inscription=$stmt->execute([$prenom_joueur, $nom_joueur, $id_equipe, $telephone_joueur, $email_joueur, $certificat_medical]);
    
    
        if ($result_inscription) {
            echo "Le joueur a été inscrit avec succès !"; 
            echo "<p><a href='index.php'><button>Revenir au classement</button></a></p>";
        } else {
            echo "Erreur lors de l'inscription du joueur : " . $stmt->error;
        }
    }
    else {
        $nom_equipe = $_POST['nom_equipe'];
        $sql = "INSERT INTO Equipe (confirmation_equipe, nom_equipe) 
                VALUES (0, ?)";
        $stmt = $mysqlClient->prepare($sql);
        $result_inscription=$stmt->execute([$nom_equipe]);
    
        if ($result_inscription) {
            echo "L'équipe a été inscrite avec succès !"; 
            echo "<p><a href='index.php'><button>Revenir au classement</button></a></p>";
        } else {
            echo "Erreur lors de l'inscription de l'équipe : " . $stmt->error;
        }
    }

} else {
    echo "Méthode non autorisée.";
}
?>
