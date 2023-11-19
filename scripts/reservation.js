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
            clickedButton.style.backgroundColor = ''; // lub możesz ustawić na inny kolor, jeśli to jest potrzebne
        }

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

// payButton.addEventListener('click', function() {
async function createReservation(facilityId, facilityName, imagePath, userId) {

    if (clickedButton) {

        // Pobierz dane rezerwacji
        // const date = clickedButton.parentElement.parentElement.querySelector('.date').textContent;
        // const time = clickedButton.textContent;

        // Przygotuj dane do wysłania na serwer
        const reservationData = {
            facility_id: facilityId,
            facility_name: facilityName,
            image_path: imagePath,
            date: bookedDate.textContent,
            start_time: startTime.textContent,
            end_time: endTime.textContent,
            user_id: userId
        };

        // Wyślij dane do serwera za pomocą żądania HTTP, na przykład za pomocą fetch lub innej metody
        const response = await fetch('server/reservation.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(reservationData),
        })

            .then(response => response.json())
            .then(data => {
                // Tutaj możesz obsłużyć odpowiedź z serwera, np. wyświetlić komunikat o sukcesie
                console.log('Rezerwacja dodana pomyślnie:', data);
            })
            .catch(error => {
                // Obsłuż błąd, jeśli wystąpi
                console.error('Wystąpił błąd podczas dodawania rezerwacji:', error);
            });
        popWindow[0].classList.add('hidden')
    } else {
        alert('Najpierw wybierz godzinę z tabeli.');
    }
}
// });