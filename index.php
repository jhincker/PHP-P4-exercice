<?php
include 'header.php';
include 'bdd.php';

try {
    $bdd = connexion();
    $oeuvres = $bdd->query('SELECT * FROM oeuvres');
    $error = false;
    // Si aucune oeuvre trouvée, on marque une erreur
    if ($oeuvres === false) {
        $error = true;
    }
} catch (Exception $e) {
    $error = true;
}

// Si erreur, redirection
if ($error) {
    die('Erreur lors de la récupération des oeuvres en base de données.');
}
?>
<div id="liste-oeuvres">
    <?php foreach ($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php include 'footer.php'; ?>