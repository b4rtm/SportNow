<?php
global $conn;
include 'head.php';
include "navbar.php";

require 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT user_id, password, name, surname, admin FROM users WHERE email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);


        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            $error = "Nieprawidłowy email lub hasło";
        }
        else {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['user_id'] = $row['user_id'];
                if($row['admin'] != NULL){
                    $_SESSION['user_role'] = 'admin';
                    header("Location: admin_panel.php");
                }
                else {
                    $_SESSION['user_role'] = 'user';
                    header("Location: index.php");
                }
                if (isset($_SESSION['previous_page'])) {
                    header('Location: ' . $_SESSION['previous_page']);
                } else {
                    header('Location: index.php');
                }
                exit();
            } else {
                // Invalid login
                $error = "Nieprawidłowy email lub hasło";
            }
        }
    }
}
?>

<div class="form-page">
    <div class="login-page">
        <div class="login-container">
            <h1>Logowanie</h1>
            <form class="register-fields" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                <div class="register-field">
                    <label>email</label>
                    <input type="email" placeholder="email" name="email" required>
                </div>
                <div class="register-field">
                    <label>hasło</label>
                    <input type="password" placeholder="Hasło" name="password" required>
                </div>
                <?php if (isset($error)) { ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php } ?>
                <button type="submit" name="login" class="register-button">
                    Zaloguj
                </button>
                <a href="register.php" style="color: white">Nie mam jeszcze konta</a>
            </form>
        </div>
    </div>
</div>
<?php include_once('footer.php'); ?>