<style>
.comment {
    display: block;
    position: relative;
    padding: 5px 15px;
    border: 1px solid grey;
    max-width: 300px;
    background: #fefefe;
    margin-bottom: 15px;
}
</style>
<?php
include 'config.php';
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
if(isset($_POST['partie_id']) && isset($_POST['commentaire']))
{
    if(!empty($_POST['commentaire'])) {
        $sql = "INSERT INTO Commentaires (commentaire, Id_Partie) VALUES (?, ?)";
        $stmt = $mysqlClient->prepare($sql);
        $result_inscription=$stmt->execute([$_POST['commentaire'], $_POST['partie_id']]);
        echo "Votre commentaire vient d'être publié !"; 
        echo "<p><a href='comments.php?idI=" . $_POST['partie_id'] . "'><button>Revenir sur tous les commentaires</button></a></p>";
        die();
    }
    else
    {
        echo "Votre commentaire ne pas être vide";
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
        <h2>⬇️ Voir les commentaires pour la partie "<b><?php echo retrieveTeamById($result_partie["id_equipe1"])['nom_equipe'] . ' VS ' . retrieveTeamById($result_partie["id_equipe2"])['nom_equipe']; ?>"</b></h2>
        <?php
        $sqlCommentaires = "SELECT * FROM Commentaires WHERE Id_Partie=? ORDER BY created_time DESC";
        $stmt = $mysqlClient->prepare($sqlCommentaires);
        $stmt->execute([$_GET['idI']]);
        $result_comments=$stmt->fetchAll();
        foreach($result_comments as $comment) {
            ?>
            <div class="comment">
                <p style="font-style: italic;margin-bottom: 5px;"><small>Publié le <?= date('d/m/Y', strtotime($comment['created_time'])); ?></small></p>
                <p style="margin-top: 0px;"><b><?= htmlspecialchars(nl2br($comment['commentaire'])); ?></b></p>
            </div>
            <?php
        }
        ?>
        <h3>Publiez votre commentaire pour le match</h3>
        <form action="" method="post" style="display: flex;gap: 10px;flex-direction: column;max-width: 350px;padding-bottom: 30px;">
            <label for="commentaire">Contenu de votre commentaire :</label>
            <textarea name="commentaire" style="min-height: 150px;"></textarea>
            <input type="hidden" name="partie_id" value="<?= $_GET['idI'] ?>"/>
            <button type="submit">Envoyer le commentaire</button>
            <small>En envoyant le commentaire, aucune donnée personnelle ne sera traitée et stockée. Votre soumission sera entièrement anonymisée.</small>
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
