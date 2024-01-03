<?php
include 'config.php';

// Fonction pour récupérer le nom de l'équipe via son identifiant

function retrieveTeamById($idEquipe) {
    include 'config.php';

    $sql = "SELECT * FROM Equipe WHERE id_equipe = ?";
    $stmt = $mysqlClient->prepare($sql);

    $result_team=$stmt->execute([$idEquipe]);
    return $stmt->fetch();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mise à jour et vérification du score, afin de s'assurer qu'il ne dépasse pas 40

if(isset($_POST['score-1']) && isset($_POST['score-2']))
{
    if($_POST['score-1']<=40 && isset($_POST['score-2'])<=40) {
        $sql = "UPDATE Equipe_Partie SET score_equipe1 = ?, score_equipe2 = ? WHERE id_equipe_partie = ?";
        $stmt = $mysqlClient->prepare($sql);
        $result_inscription=$stmt->execute([$_POST['score-1'], $_POST['score-2'], $_POST['id_equipe_internal']]);
        echo "Le score vient d'être mis-à-jour !"; 
        echo "<p><a href='index.php'><button>Revenir au classement</button></a></p>";
    }
    else
    {
        echo "Le score d'une des deux équipe ne peux pas être supérieur à 40 points";
    }
}
if (isset($_GET['idI'])) {
    include('config.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    $sql = "SELECT * FROM Equipe_Partie WHERE id_equipe_partie=?";
    $stmt = $mysqlClient->prepare($sql);
    $stmt->execute([$_GET['idI']]);
    $result_partie=$stmt->fetch();
    if($result_partie)
    {
        ?>
        <h2>Enregistrer un score pour la partie</h2>
        <h3><?php echo retrieveTeamById($result_partie["id_equipe1"])['nom_equipe'] . ' VS ' . retrieveTeamById($result_partie["id_equipe2"])['nom_equipe']; ?></h3>
        <form action="" method="post" style="display: flex;gap: 10px;flex-direction: column;max-width: 350px;padding-bottom: 30px;">
            <label for="score-1">Score de la première équipe :</label>
            <input type="number" name="score-1" max="40" min="0" value="<?= $result_partie["score_equipe1"] ?>"/>
            <label for="score-2">Score de la deuxième équipe :</label>
            <input type="number" name="score-2" max="40" min="0" value="<?= $result_partie["score_equipe2"] ?>"/>
            <input type="hidden" value="<?= $result_partie["id_equipe_partie"] ?>" name="id_equipe_internal"/>
            <button type="submit">Enregistrer le score</button>
        </form>
        <?php
    }
    else
    {
        echo "Cette partie n'existe pas, merci de revenir en arrière";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
