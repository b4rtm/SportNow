<?php

global $conn;
include 'head.php';
require 'db/db_functions.php';

$centres = getAllCentres();
$facilities = getFacilities();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $name = $_POST['edit_facility_name'];
        $sport = $_POST['edit_sport'];
        $edit_price = $_POST['edit_price'];
        $edit_open = $_POST['edit_open'];
        $edit_close = $_POST['edit_close'];
        $edit_desc = $_POST['edit_desc'];
        $edit_centre = $_POST['edit_centre'];

        if (isset($_POST['edit_img'])) {
            $edit_img = $_POST['edit_img'];
            $fileName = $_FILES["edit_img"]["name"];
            $fileError = $_FILES["edit_img"]["error"];
            $fileTmp = $_FILES["edit_img"]["tmp_name"];
            if ($fileError === 0) {
                // Przenieś plik do docelowego katalogu (możesz dostosować ścieżkę do swoich potrzeb)
                $destination = "images/sport_facilities_images/" . $fileName;
                move_uploaded_file($fileTmp, $destination);

                echo "Plik został pomyślnie przesłany i zapisany jako: $fileName";
            } else {
                echo "Wystąpił błąd podczas przesyłania pliku.";
            }

            $pathName = "images/sport_facilities_images/" . $fileName;
        }

        $centre = getCentreByName($edit_centre);
        $sportId = createOrGetSportId($sport);

        $checkIfExistsSql = "SELECT COUNT(*) FROM sportfacilities WHERE facility_id = :facility_id";
        $checkIfExistsStmt = $conn->prepare($checkIfExistsSql);
        $checkIfExistsStmt->bindParam(':facility_id', $id);
        $checkIfExistsStmt->execute();
        $rowCount = $checkIfExistsStmt->fetchColumn();

        if ($rowCount > 0) {
            if(isset($_POST['edit_img'])){
                $sql = "UPDATE sportfacilities SET facility_name= :facility_name, description= :description, booking_price= :booking_price, centre_id= :centre_id, sport_id= :sport_id, image_path= :image_path,opening_hour= :opening_hour, closing_hour= :closing_hour  WHERE facility_id = :facility_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':facility_id', $id);
                $stmt->bindParam(':image_path', $pathName);
            }
            else{
                $sql = "UPDATE sportfacilities SET facility_name= :facility_name, description= :description, booking_price= :booking_price, centre_id= :centre_id, sport_id= :sport_id,opening_hour= :opening_hour, closing_hour= :closing_hour  WHERE facility_id = :facility_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':facility_id', $id);
            }
        }
        else{
            $sql = "INSERT INTO sportfacilities (facility_name, description, booking_price, centre_id, sport_id, image_path, opening_hour, closing_hour) 
                                    VALUES (:facility_name, :description, :booking_price, :centre_id, :sport_id, :image_path, :opening_hour, :closing_hour)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':image_path', $pathName);
        }
        $stmt->bindParam(':facility_name', $name);
        $stmt->bindParam(':description', $edit_desc);
        $stmt->bindParam(':booking_price', $edit_price);
        $stmt->bindParam(':centre_id', $centre['centre_id']);
        $stmt->bindParam(':sport_id', $sportId);
        $stmt->bindParam(':opening_hour', $edit_open);
        $stmt->bindParam(':closing_hour', $edit_close);

        $stmt->execute();

    }

    header('Location: edit_facility.php');
    exit();
}

?>


<div id="edit-facility-page">
    <div class="title">
        <img src="images/main_page_images/logo.png" alt="Logo strony" class="logo">
        <h1>Edytuj obiekt sportowy</h1>
    </div>
    <div class="facilities-container">
        <div id="table-container">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Jednostka sportowa</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($facilities as $facility): ?>
                    <tr>
                        <td>
                            <p data-field="facility_id"><?= $facility['facility_id']; ?></p>
                        </td>
                        <td>
                            <p><?= $facility['facility_name']; ?></p>
                        <td>
                            <?php $centre = getCentreById($facility['centre_id']);
                                  $sport = getSportById($facility['sport_id'])
                            ?>
                            <p><?= $centre['centre_name'] ?> </p>
                        </td>
                        <td>
                            <svg  onclick="editFacility('<?=$facility['facility_id']?>', '<?=$facility['facility_name']?>','<?=$facility['description']?>','<?=$facility['booking_price']?>', '<?=$sport['sport_name']?>','<?=$facility['opening_hour']?>','<?=$facility['closing_hour']?>','<?=$centre['centre_name']?>')" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="2em" height="2em" viewBox="0 0 50 50" fill="white"><title>Edytuj</title>
                                <path d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z"></path>
                            </svg>
                        </td>
                        <td>
                            <svg  onclick="displayModal('<?=$facility['facility_id']?>')" class="delete-icon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="2em" height="2em" viewBox="0 0 24 24" fill="white"><title>Usuń</title>
                                <path d="M 10 2 L 9 3 L 3 3 L 3 5 L 4.109375 5 L 5.8925781 20.255859 L 5.8925781 20.263672 C 6.023602 21.250335 6.8803207 22 7.875 22 L 16.123047 22 C 17.117726 22 17.974445 21.250322 18.105469 20.263672 L 18.107422 20.255859 L 19.890625 5 L 21 5 L 21 3 L 15 3 L 14 2 L 10 2 z M 6.125 5 L 17.875 5 L 16.123047 20 L 7.875 20 L 6.125 5 z"></path>
                            </svg>
                            <div class=modal id="modal<?=$facility['facility_id']?>">
                                <div class="modal-content">
                                    <p>Czy na pewno chcesz usunąć?</p>
                                    <button  onclick="deleteFacility('<?=$facility['facility_id']?>')" id="confirmDelete">Usuń</button>
                                    <button onclick="hideModal('<?=$facility['facility_id']?>')" id="cancelDelete">Anuluj</button>
                                </div>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <button onclick="editFacility('','','','','','','','','')">Dodaj</button>
        </div>

        <div id="edit-form-container" style="display: none;">
            <h2>Formularz Edycji </h2>
            <form id="edit-form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="id" id="edit-id" hidden="hidden">
                <label for="edit-facility-name">Nazwa:
                    <input type="text" name="edit_facility_name" id="edit-facility-name" required>
                </label>
                <label for="edit-sport">Sport:
                    <input type="text" name="edit_sport" id="edit-sport" required>
                </label>
                <label for="edit-price">Cena:
                    <input type="number" min="0" name="edit_price" id="edit-price" required>
                </label>
                <label for="edit-open">Godzina otwarcia:
                    <input type="number" min="1" max="24" name="edit_open" id="edit-open" required>
                </label>
                <label for="edit-close">Godzina zamknięcia:
                    <input type="number" min="1" max="24" name="edit_close" id="edit-close" required>
                </label>
                <label for="edit-desc">Opis:
                    <input type="text" name="edit_desc" id="edit-desc" required>
                </label>
                <label>Jednostka sportowa:
                    <select id="select-centre" name="edit_centre">
                        <?php foreach ($centres as $centre): ?>
                            <option value="<?= $centre['centre_name']?>"><?= $centre['centre_name']?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="edit-img">Wybierz zdjęcie:
                    <input type="file" name="edit_img" id="edit-img">
                </label>
                <button type="submit" name="edit">Zapisz</button>
            </form>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="scripts/admin.js"></script>