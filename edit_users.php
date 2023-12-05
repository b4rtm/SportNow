<?php

global $conn;
include 'head.php';
require 'db/db_functions.php';

$users = getAllUsers();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $name = $_POST['edit_name'];
        $surname = $_POST['edit_surname'];
        $email = $_POST['edit_email'];
        $phone = $_POST['edit_phone'];
        $pesel = $_POST['edit_pesel'];
        $city = $_POST['edit_city'];
        $street = $_POST['edit_street'];
        $property_no = $_POST['edit_property'];

        $sql = "UPDATE users SET name= :name, surname= :surname, email= :email  WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $sql = "UPDATE userdetails SET phone_no= :phone_no, PESEL= :pesel, city= :city, street= :street, property_no= :property_no WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $id);
        $stmt->bindParam(':phone_no', $phone);
        $stmt->bindParam(':pesel', $pesel);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':property_no', $property_no);
        $stmt->execute();

    }

    header('Location: edit_users.php');
    exit();
}

?>


<div id="edit-user-page">
    <div class="title">
        <img src="images/main_page_images/logo.png" alt="Logo strony" class="logo">
        <h1>Edytuj kompleks sportowy </h1>
    </div>
    <div class="users-container">
        <div id="table-container">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>email</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($users as $user): ?>
                    <?php $user_details = getUserDetailsById($user['user_id']);?>
                    <tr>
                        <td>
                            <p data-field="user_id"><?= $user['user_id']; ?></p>
                        </td>
                        <td>
                            <p><?= $user['name']; ?></p>
                        <td>
                            <p><?= $user['surname']; ?></p>
                        </td>
                        <td>
                            <p><?= $user['email']; ?></p>
                        </td>
                        <td><svg  onclick="editUser('<?=$user['user_id']?>', '<?=$user['name']?>', '<?=$user['surname']?>', '<?=$user['email']?>', '<?=$user_details['phone_no']?>', '<?=$user_details['PESEL']?>', '<?=$user_details['city']?>', '<?=$user_details['street']?>', '<?=$user_details['property_no']?>')" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="2em" height="2em" viewBox="0 0 50 50" fill="white"><title>Edytuj</title>
                                <path d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z"></path>
                            </svg>
                        </td>
                        <td>
                            <svg  onclick="displayModal('<?=$user['user_id']?>')" class="delete-icon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="2em" height="2em" viewBox="0 0 24 24" fill="white"><title>Usuń</title>
                                <path d="M 10 2 L 9 3 L 3 3 L 3 5 L 4.109375 5 L 5.8925781 20.255859 L 5.8925781 20.263672 C 6.023602 21.250335 6.8803207 22 7.875 22 L 16.123047 22 C 17.117726 22 17.974445 21.250322 18.105469 20.263672 L 18.107422 20.255859 L 19.890625 5 L 21 5 L 21 3 L 15 3 L 14 2 L 10 2 z M 6.125 5 L 17.875 5 L 16.123047 20 L 7.875 20 L 6.125 5 z"></path>
                            </svg>
                            <div class=modal id="modal<?=$user['user_id']?>">
                                <div class="modal-content">
                                    <p>Czy na pewno chcesz usunąć?</p>
                                    <button  onclick="deleteUser('<?=$user['user_id']?>')" id="confirmDelete">Usuń</button>
                                    <button onclick="hideModal('<?=$user['user_id']?>')" id="cancelDelete">Anuluj</button>
                                </div>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="edit-form-container" style="display: none;">
            <h2>Formularz Edycji </h2>
            <form id="edit-form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="id" id="edit-id" hidden="hidden">
                <label for="edit-name">Imię:
                    <input type="text" name="edit_name" id="edit-name" required>
                </label>
                <label for="edit-surname">Nazwisko:
                    <input type="text" name="edit_surname" id="edit-surname" required>
                </label>
                <label for="edit-email">Email:
                    <input type="text" name="edit_email" id="edit-email" required>
                </label>
                <label for="edit-phone">Nr telefonu:
                    <input type="text" name="edit_phone" id="edit-phone" required>
                </label>
                <label for="edit-pesel">PESEL:
                    <input type="text" name="edit_pesel" id="edit-pesel" required>
                </label>
                <label for="edit-city">Miasto:
                    <input type="text" name="edit_city" id="edit-city" required>
                </label>
                <label for="edit-street">Ulica:
                    <input type="text" name="edit_street" id="edit-street" required>
                </label>
                <label for="edit-property">Nr budynku:
                    <input type="text" name="edit_property" id="edit-property" required>
                </label>
                <button type="submit" name="edit">Zapisz</button>
            </form>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="scripts/admin.js"></script>