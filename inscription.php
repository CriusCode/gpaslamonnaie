<?php
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$sql = "SELECT * FROM Equipe";
$stmt = $mysqlClient->query($sql);

$result_inscription=$stmt->fetchAll();
?>

<h2>Formulaire d'inscription d'un joueur</h2>

<form action="traitement_inscription.php" method="post" style="display: flex;gap: 10px;flex-direction: column;max-width: 350px;padding-bottom: 30px;">
    <label for="prenom_joueur">Prénom :</label>
    <input type="text" id="prenom_joueur" name="prenom_joueur" required>

    <label for="nom_joueur"> Nom :</label>
    <input type="text" id="nom_joueur" name="nom_joueur" required>

    <label for="nom_equipe">Nom de l'Équipe :</label>
    <!-- <input type="text" id="nom_equipe" name="nom_equipe" required> -->
    <select id="nom_equipe" name="nom_equipe">
        <?php
        foreach($result_inscription as $equipe) {
            ?>
            <option value="<?= $equipe['id_equipe'] ?>"><?= $equipe['nom_equipe'] ?></option>
            <?php
        }
        ?>
    </select>

    <label for="telephone_joueur">Numéro de Téléphone :</label>
    <input type="text" id="telephone_joueur" name="telephone_joueur" required>

    <label for="email_joueur">Adresse Email :</label>
    <input type="email" id="email_joueur" name="email_joueur" required>

    <label for="certificat_medical">Certificat d'Aptitude Sportive :</label>
    <input type="text" id="certificat_medical" name="certificat_medical" required>

    <button type="submit">Inscrire le joueur</button>
</form>