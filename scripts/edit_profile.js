const form = document.getElementById('profile-form');
const formElements = form.elements;
const editButton = document.querySelector('button[onclick="toggleFormEdit()"]');
const saveButton = document.querySelector('button[type="submit"]');
document.addEventListener('DOMContentLoaded', function () {

    for (let i = 0; i < formElements.length -2; i++) {
        formElements[i].disabled = true;
    }

    editButton.addEventListener('click', function (event) {
        event.preventDefault();

    });
});

function toggleFormEdit() {

    for (var i = 0; i < formElements.length-2; i++) {
        formElements[i].disabled = false;
    }

    editButton.style.visibility = 'hidden';
    saveButton.style.visibility = 'visible';
}