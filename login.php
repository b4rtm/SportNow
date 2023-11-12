<?php
global $conn;
include 'head.php';
include "navbar.php";

require 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT user_id, password, name, surname FROM users WHERE email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);


        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: index.php");
            exit();
        } else {
            // Invalid login
            echo "Invalid email or password.";
        }
    }
}
?>


<div class="register-page">
    <div class="register-container">
        <h1>Logowanie</h1>
        <form class="register-fields" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <div class="register-field">
                <label>email</label>
                <input type="email" placeholder="email" name="email" required>
            </div>
            <div class="register-field">
                <label>Hasło</label>
                <input type="password" placeholder="Hasło" name="password" required>
            </div>
            <button type="submit" name="login">
                Zaloguj
            </button>
            <a href="register.php">Nie mam jeszcze konta</a>
        </form>
    </div>
</div>
