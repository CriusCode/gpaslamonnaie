<?php
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$sql = "SELECT * FROM Equipe";
$stmt = $mysqlClient->query($sql);

$result_inscription=$stmt->fetchAll();
?>

<h2>Formulaire d'enregistrement d'une nouvelle partie</h2>

<!-- Permet d'avoir un select qui s'alimente depuis la base de données -->

<form action="creation-partie.php" method="post" style="display: flex;gap: 10px;flex-direction: column;max-width: 350px;padding-bottom: 30px;">
    <label for="premiere_equipe">Première équipe :</label>
    <select id="premiere_equipe" name="premiere_equipe">
        <?php
        foreach($result_inscription as $equipe) {
            ?>
            <option value="<?= $equipe['id_equipe'] ?>"><?= $equipe['nom_equipe'] ?></option>
            <?php
        }
        ?>
    </select>
    <label for="deuxieme_equipe">Deuxième équipe :</label>
    <select id="deuxieme_equipe" name="deuxieme_equipe">
        <?php
        foreach($result_inscription as $equipe) {
            ?>
            <option value="<?= $equipe['id_equipe'] ?>"><?= $equipe['nom_equipe'] ?></option>
            <?php
        }
        ?>
    </select>
    <button type="submit">Créer la partie</button>
</form>