<?php

include 'head.php';
include "navbar.php";

include_once('db/db_functions.php');
include_once 'functions.php';

$user_data = getUserById(($_SESSION['user_id']));
$user_details = getUserDetailsById(($_SESSION['user_id']));

?>

<div id="edit-profile-page">
    <h1>Edytuj profil</h1>

    <form action="update_profile.php" method="post">
        <label for="username">Imię:</label>
        <input type="text" name="name" value="<?= $user_data['name'] ?>" required>

        <label for="username">Nazwisko:</label>
        <input type="text" name="name" value="<?= $user_data['surname'] ?>" required>

        <label for="email">Adres email:</label>
        <input type="email" name="email" value="<?= $user_data['email'] ?>" required>


        <input type="submit" value="Zapisz zmiany">
    </form>
</div>