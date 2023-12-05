<?php
global $conn;
include 'head.php';
include "navbar.php";

require 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $user_id = $_POST['user_id'];
        $phone_no = $_POST['phone_no'];
        $pesel = $_POST['pesel'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $property_no = $_POST['property_no'];


        if ($password !== $confirm_password) {
            $message = "Hasła nie pasują do siebie.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (email, password, name, surname) VALUES (:email, :password, :name, :surname)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            if ($stmt->execute()) {
                $user_id = $conn->lastInsertId();


                $sql = "INSERT INTO userdetails (user_id, phone_no, PESEL, city, street, property_no) VALUES (:user_id, :phone_no, :pesel, :city, :street, :property_no)";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':phone_no', $phone_no);
                $stmt->bindParam(':pesel', $pesel);
                $stmt->bindParam(':city', $city);
                $stmt->bindParam(':street', $street);
                $stmt->bindParam(':property_no', $property_no);

                $stmt->execute();

                $success =  "Rejestracja zakończona pomyślnie.";
            } else {
                $message = "Błąd podczas rejestracji: " . $stmt->error;
            }
        }
    }
}
?>
<div class="form-page">
    <div class="register-page">
        <div class="register-container">
            <h1>Rejestracja</h1>
            <form  method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                <div class="register-fields">
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
                        <label>Numer telefonu</label>
                        <input type="text" placeholder="Nr telefonu" name="phone_no" pattern="[0-9]{9,12}" required>
                    </div>
                    <div class="register-field">
                        <label>Hasło</label>
                        <input type="password" placeholder="Hasło" name="password" required>
                    </div>
                    <div class="register-field">
                        <label>Potwierdź hasło</label>
                        <input type="password" placeholder="Hasło" name="confirm_password" required>
                    </div>
                    <div class="register-field">
                        <label>PESEL</label>
                        <input type="text" placeholder="PESEL" name="pesel" pattern="[0-9]{11}" required>
                    </div>
                    <div class="register-field">
                        <label>Miejscowość</label>
                        <input type="text" placeholder="Miejscowość" name="city" required>
                    </div>
                    <div class="register-field">
                        <label>Ulica</label>
                        <input type="text" placeholder="Ulica" name="street" required>
                    </div>
                    <div class="register-field">
                        <label>Numer domu</label>
                        <input type="text" placeholder="Numer domu" name="property_no" required>
                    </div>
                </div>
                <?php if (isset($message)) { ?>
                    <p class="error"><?php echo $message; ?></p>
                <?php } ?>
                <?php if (isset($success)) { ?>
                    <p class="success"><?php echo $success; ?></p>
                <?php } ?>
                <button type="submit" name="register" class="register-button">
                    Utwórz konto
                </button>
            </form>
        </div>
    </div>
</div>
<?php include_once('footer.php'); ?>