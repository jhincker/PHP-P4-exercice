<?php
include 'header.php';
include 'bdd.php';

$bdd = connexion();

// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
if (empty($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$oeuvre = null;
$error = false;

try {
    $requete = $bdd->prepare('SELECT * FROM `oeuvres` WHERE id = ?');
    $requete->execute([$_GET['id']]);
    $oeuvre = $requete->fetch();

    // Si aucune oeuvre trouvée, on marque une erreur
    if ($oeuvre === false) {
        $error = true;
    }
} catch (Exception $e) {
    $error = true;
}

// Si erreur, redirection
if ($error) {
    header('Location: index.php');
    exit();
}
?>
<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
            <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php include 'footer.php'; ?>