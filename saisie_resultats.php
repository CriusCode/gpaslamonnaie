<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie des Résultats</title>
</head>
<body>

<h2>Formulaire de Saisie des Résultats</h2>

<form action="traitement_resultats.php" method="post">
    <label for="equipe1">Équipe 1 :</label>
    <select id="equipe1" name="equipe1" required>
        <input value="1">Nom Équipe 1</input>
        <option value="2">Nom Équipe 2</option>
    </select>

    <label for="equipe2">Équipe 2 :</label>
    <select id="equipe2" name="equipe2" required>
        <option value="1">Nom Équipe 1</option>
        <option value="2">Nom Équipe 2</option>
    </select>

    <label for="score1">Score Équipe 1 :</label>
    <input type="number" id="score1" name="score1" required>

    <label for="score2">Score Équipe 2 :</label>
    <input type="number" id="score2" name="score2" required>

    <button type="submit">Enregistrer les Résultats</button>
</form>

</body>
</html>
