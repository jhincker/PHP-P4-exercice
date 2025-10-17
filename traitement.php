<?php
include 'bdd.php';
$bdd = connexion();
$sqlQuery = 'INSERT INTO oeuvres(titre, description, artiste, image) VALUES(:titre, :description, :artiste, :image)';
if (
    empty($_POST['titre']) || empty($_POST['description']) || empty($_POST['artiste']) || empty($_POST['image'])
    || strlen($_POST['description']) < 3
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)
) {
    header('Location: ajouter.php?error=true');
} else {
    // Préparation
    $insertOeuvre = $bdd->prepare($sqlQuery);

    // Exécution ! L'oeuvre' est maintenant en base de données
    $insertOeuvre->execute([
        'titre' => htmlspecialchars($_POST['titre']),
        'description' => htmlspecialchars($_POST['description']),
        'artiste' => htmlspecialchars($_POST['artiste']),
        'image' => htmlspecialchars($_POST['image'])
    ]);
    $id = $bdd->lastInsertId();
    header('Location: oeuvre.php?id=' . $id);
}
