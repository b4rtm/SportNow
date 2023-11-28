const backgrounds = [
    'url("../images/main_page_images/main_photo1.jpg")',
    'url("../images/main_page_images/main_photo2.jpg")',
    'url("../images/main_page_images/main_photo3.jpg")',
    'url("../images/main_page_images/main_photo4.jpg")'
];

let currentBackground = 0;
const backgroundSlider = document.getElementById('backgroundSlider');
let intervalId;

function changeBackground() {
    backgroundSlider.style.backgroundImage = backgrounds[currentBackground];
}

function nextSlide() {
    currentBackground = (currentBackground + 1) % backgrounds.length;
    changeBackground();
    resetInterval();
}

function prevSlide() {
    currentBackground = (currentBackground - 1 + backgrounds.length) % backgrounds.length;
    changeBackground();
    resetInterval();
}

function resetInterval() {
    clearInterval(intervalId);
    intervalId = setInterval(nextSlide, 5000);
}

resetInterval();