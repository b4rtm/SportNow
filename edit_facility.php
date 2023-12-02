<?php

include 'head.php';
require 'db/db_functions.php';

$facilities = getFacilities();
?>


<div id="edit-facility-page">
    <h1>Edytuj obiekty</h1>
    <div class="facilities-container">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Nazwa Jednostki</th>
                <th>Miasto</th>
            </tr>
            </thead>
            <tbody>
            <?php
             foreach ($facilities as $facility): ?>
            <?php $sport_centre = getCentreById($facility["centre_id"])?>
<!--            <div class="item">-->
                <tr>
                    <td>
                        <p data-field="facility_id"><?= $facility['facility_id']; ?></p>
                    </td>
                    <td>
                        <p><?= $facility['facility_name']; ?></p>
                    </td>
                    <td>
                        <p><?= $sport_centre['centre_name']; ?></p>
                    </td>
                    <td>
                        <p><?= $sport_centre['city']; ?></p>
                    </td>
                    <td>
                        <svg  class="edit-icon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50" fill="white"><title>Edytuj</title>
                            <path d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z"></path>
                        </svg>
                    </td>
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 24 24" fill="white"><title>Usuń</title>
                            <path d="M 10 2 L 9 3 L 3 3 L 3 5 L 4.109375 5 L 5.8925781 20.255859 L 5.8925781 20.263672 C 6.023602 21.250335 6.8803207 22 7.875 22 L 16.123047 22 C 17.117726 22 17.974445 21.250322 18.105469 20.263672 L 18.107422 20.255859 L 19.890625 5 L 21 5 L 21 3 L 15 3 L 14 2 L 10 2 z M 6.125 5 L 17.875 5 L 16.123047 20 L 7.875 20 L 6.125 5 z"></path>
                        </svg>
                    </td>
                </tr>
<!--            </div>-->
            <?php endforeach; ?>
            </tbody>
        </table>
        <!-- W miejscu, gdzie chcesz wyświetlać formularz edycji -->
        <div id="edit-form-container" style="display: none;">
            <h2>Formularz Edycji Obiektu</h2>
            <form id="edit-form" action="update_object.php" method="post">
                <input type="text" name="facility_id" id="edit-facility-id" value="">
                <label for="edit-facility-name">Nazwa:</label>
                <input type="text" name="facility_name" id="edit-facility-name" required>
                <!-- Dodaj inne pola do edycji -->
                <button type="submit">Zapisz zmiany</button>
            </form>
        </div>

    </div>
</div>

<script>
    // W pliku z danymi lub osobnym pliku JavaScript
    document.querySelectorAll('.edit-icon').forEach(function(icon) {
        icon.addEventListener('click', function() {
            // Pobierz dane obiektu z wiersza tabeli
            // const facilityId = icon.closest('tr').querySelector('p[data-field="facility_id"]').textContent;

            document.getElementById('edit-facility-id').value = facilityId;

            document.getElementById('edit-form-container').style.display = 'block';
        });
    });

</script>