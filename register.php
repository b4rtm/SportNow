<?php
global $conn;
include 'head.php';
include "navbar.php";

require 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
// User clicked the registration button
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

// Validate user input - perform additional validation as needed
        if ($password !== $confirm_password) {
            echo "Hasła nie pasują do siebie.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (email, password, name, surname) VALUES (:email, :password, :name, :surname)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            if ($stmt->execute()) {
                echo "Rejestracja zakończona pomyślnie.";
            } else {
                echo "Błąd podczas rejestracji: " . $stmt->error;
            }
        }
    }
}
?>

<div class="register-page">
    <div class="register-container">
        <h1>Rejestracja</h1>
        <form class="register-fields" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <div class="register-field">
                <label>Imię</label>
                <input type="text" placeholder="Imię" name="name" required>
            </div>
            <div class="register-field">
                <label>Nazwisko</label>
                <input type="text" placeholder="Nazwisko" name="surname" required>
            </div>
            <div class="register-field">
                <label>email</label>
                <input type="email" placeholder="email" name="email" required>
            </div>
            <div class="register-field">
                <label>Hasło</label>
                <input type="password" placeholder="Hasło" name="password" required>
            </div>
            <div class="register-field">
                <label>Potwierdź hasło</label>
                <input type="password" placeholder="Hasło" name="confirm_password" required>
            </div>
            <button type="submit" name="register" class="register-button">
                Utwórz konto
            </button>
        </form>
    </div>
</div>
