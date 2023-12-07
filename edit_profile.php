<?php

global $conn;
include 'head.php';
include "navbar.php";

include_once('db/db_functions.php');
include_once 'functions.php';

$user_data = getUserById(($_SESSION['user_id']));
$user_details = getUserDetailsById(($_SESSION['user_id']));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        $email = processString($_POST['email']);
        $phone_no = processString($_POST['phone_no']);
        $city = processString($_POST['city']);
        $street = processString($_POST['street']);
        $property_no = processString($_POST['property_no']);

        $sql = "UPDATE users SET email= :email WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':user_id', $user_id);

        $stmt->execute();

        $sql = "UPDATE userdetails SET phone_no= :phone_no, city= :city, street= :street, property_no= :property_no WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':phone_no', $phone_no);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':property_no', $property_no);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);

        $stmt->execute();

    }

    header('Location: edit_profile.php');
    exit();
}
?>

<div id="edit-profile-page">
    <h1>Szczegóły konta</h1>

    <div class="profile-container">
        <div>
            <p style="font-size: 25px; color: rgb(183,182,182);">Imię i nazwisko</p>
            <p style="font-size: 30px;"><?= $user_data['name'] ?> <?= $user_data['surname'] ?></p>
        </div>
        <form  id="profile-form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="register-fields">
                <div class="register-field">
                    <label>email</label>
                    <input type="email" name="email" value="<?= $user_data['email'] ?>" required >
                </div>
                <div class="register-field">
                    <label>Numer telefonu</label>
                    <input type="text" value="<?= $user_details['phone_no'] ?>" name="phone_no" pattern="[0-9]{9,12}" required >
                </div>
                <div class="register-field">
                    <label>Miejscowość</label>
                    <input type="text" value="<?= $user_details['city'] ?>" name="city" required >
                </div>
                <div class="register-field">
                    <label>Ulica</label>
                    <input type="text" value="<?= $user_details['street'] ?>" name="street" required>
                </div>
                <div class="register-field">
                    <label>Numer domu</label>
                    <input type="text" value="<?= $user_details['property_no'] ?>" name="property_no" required >
                </div>
            </div>
            <button name="edit" class="edit-button" onclick="toggleFormEdit()">
                Edytuj profil
            </button>
            <button type="submit" name="edit" class="save-button" style="visibility: hidden">
                Zapisz
            </button>
        </form>
    </div>
    <script src="scripts/edit_profile.js"></script>
</div>
<?php include_once('footer.php'); ?>