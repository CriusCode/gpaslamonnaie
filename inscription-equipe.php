<?php
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>

<h2>Formulaire d'enregistrement d'une nouvelle équipe</h2>

<form action="traitement_inscription.php" method="post" style="display: flex;gap: 10px;flex-direction: column;max-width: 350px;padding-bottom: 30px;">
    <label for="nom_equipe">Nom équipe :</label>
    <input type="text" id="nom_equipe" name="nom_equipe" required>
    <input type="hidden" name="register-equipe" value="true"/>
    <button type="submit">Inscrire l'équipe</button>
</form>