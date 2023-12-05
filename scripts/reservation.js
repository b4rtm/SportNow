// JavaScript do obsługi interakcji
const timeButtons = document.querySelectorAll('.time-button');
const popWindow = document.getElementsByClassName('pop-window');
const buyButton = document.getElementById('buy-button');
const payButton = document.getElementById('pay-button');
const bookedDate = document.getElementById('booked-date');
const startTime = document.getElementById('start-time');
const endTime = document.getElementById('end-time');

let clickedButton = null;

timeButtons.forEach(button => {
    button.addEventListener('click', function(event) {

        if (clickedButton) {
            clickedButton.style.backgroundColor = '';
        }
        if(clickedButton !== button)
            button.style.backgroundColor = 'red';
        clickedButton = event.target;
    });
});

buyButton.addEventListener('click', function() {
    if (clickedButton) {
        popWindow[0].classList.remove('hidden');
        const date = clickedButton.parentElement.parentElement.querySelector('.date').textContent;
        const time = clickedButton.textContent;
        bookedDate.textContent = date;
        startTime.textContent = time;

        const [hour, minute] = startTime.textContent.split(':');
        const dateFormat = new Date();
        dateFormat.setHours(parseInt(hour, 10), parseInt(minute, 10), 0, 0);
        const endDateFormat = new Date(dateFormat.getTime() + 60 * 60 * 1000);
        endTime.textContent = endDateFormat.getHours() + ':' + endDateFormat.getMinutes() + '0';

    } else {
        alert('Najpierw wybierz godzinę z tabeli.');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var closeButton = document.getElementById('close-window');

    closeButton.addEventListener('click', function () {
        popWindow[0].classList.add('hidden');
    });
});

async function createReservation(facilityId, facilityName, imagePath, userId) {

    if (clickedButton) {

        const reservationData = {
            facility_id: facilityId,
            facility_name: facilityName,
            image_path: imagePath,
            date: bookedDate.textContent,
            start_time: startTime.textContent,
            end_time: endTime.textContent,
            user_id: userId
        };

        const response = await fetch('server/reservation.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(reservationData),
        })

            .then(response => response.json())
            .then(data => {
                console.log('Rezerwacja dodana pomyślnie:', data);
            })
            .catch(error => {
                console.error('Wystąpił błąd podczas dodawania rezerwacji:', error);
            });
        popWindow[0].classList.add('hidden')
        window.location.href = 'thanks.php';
    } else {
        alert('Najpierw wybierz godzinę z tabeli.');
    }
}


function toggleFavorite(facilityId) {
    $.ajax({
        url: 'server/toggleFavourite.php',
        method: 'POST',
        data: { facility_id: facilityId },
        success: function(response) {
            console.log(response);
            $('#heartIcon').css('fill', response.isFavourite ? 'red' : 'white');
            location.reload()
        },
        error: function(error) {
            console.error('Błąd AJAX: ' + error);
        }
    });
}