function editCentre(centreId, name, city, street, propertyNo, information){
    document.getElementById('edit-id').value = centreId;
    document.getElementById('edit-centre-name').value = name;
    document.getElementById('edit-city').value = city;
    document.getElementById('edit-street').value = street;
    document.getElementById('edit-property').value = propertyNo;
    document.getElementById('edit-info').value = information;

    document.getElementById('edit-form-container').style.display = 'block';
}

function displayModal(id) {
    const modal = document.getElementById('modal' + id);
    modal.style.display = 'block';
}

function deleteCentre(id){
    const modal = document.getElementById('modal' + id);
    modal.style.display = 'none';

    $.ajax({
        url: 'server/adminFunctions.php',
        method: 'POST',
        data: { centre_id: id },
        success: function() {
            location.reload()
        },
        error: function(error) {
            console.error('Błąd AJAX: ' + error);
        }
    });
}

function hideModal(id){
    const modal = document.getElementById('modal' + id);
    modal.style.display = 'none';
}


function editFacility(facilityId, name, description, bookingPrice, sportName, openingHour, closingHour, centreName){
    document.getElementById('edit-id').value = facilityId;
    document.getElementById('edit-facility-name').value = name;
    document.getElementById('edit-desc').value = description;
    document.getElementById('edit-price').value = bookingPrice;
    document.getElementById('edit-open').value = openingHour;
    document.getElementById('edit-sport').value = sportName;
    document.getElementById('edit-close').value = closingHour;
    document.getElementById('select-centre').value = centreName;


    document.getElementById('edit-form-container').style.display = 'block';
}

function deleteFacility(id){
    const modal = document.getElementById('modal' + id);
    modal.style.display = 'none';

    $.ajax({
        url: 'server/adminFunctions.php',
        method: 'POST',
        data: { facility_id: id },
        success: function() {
            location.reload()
        },
        error: function(error) {
            console.error('Błąd AJAX: ' + error);
        }
    });
}


function editReservation(reservationId, facilityName, date, start_time, user_id){
    const startHour = start_time.split(':')[0];

    document.getElementById('edit-id').value = reservationId;
    document.getElementById('edit-facility-name').value = facilityName;
    document.getElementById('edit-date').value = date;
    document.getElementById('edit-start').value = startHour;
    document.getElementById('edit-userid').value = user_id;

    document.getElementById('new-form-container').style.display = 'none';
    document.getElementById('edit-form-container').style.display = 'block';
}

function deleteReservation(id){
    const modal = document.getElementById('modal' + id);
    modal.style.display = 'none';

    $.ajax({
        url: 'server/adminFunctions.php',
        method: 'POST',
        data: { reservation_id: id },
        success: function() {
            location.reload()
        },
        error: function(error) {
            console.error('Błąd AJAX: ' + error);
        }
    });
}

function createNewReservation(){
    document.getElementById('edit-form-container').style.display = 'none';
    document.getElementById('new-form-container').style.display = 'block';

}