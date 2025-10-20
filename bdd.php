<?php
// Création d'une fonction pour accèder à la base de données grâce à PDO
function connexion()
{
    return new PDO('mysql:dbname=artbox;host=localhost', 'root', '');
}
