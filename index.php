<?php
include 'head.php';
include 'navbar.php';
?>
<div class="container" id="backgroundSlider">
    <div class="arrow left" onclick="prevSlide()">&#9664;</div>
    <div class="main_header"><p>Zarezerwuj swoje ulubione boisko już teraz!<p></div><br><br>
    <div class="arrow right" onclick="nextSlide()">&#9654;</div>
    <div class="reserve_button"><a href="reservation_offers.php">Rezerwuj</a></div>
</div>
<div style="background-color:#28303f;padding-bottom: 100px;"></div>
<div class="tiles">
    <div class="tile">
        <img src="images/main_page_images/football.png" alt="football image">
        <a>Boiska do piłki nożnej</a>
    </div>
    <div class="tile">
        <img src="images/main_page_images/running.png" alt="running image">
        <a>Bieżnie</a>
    </div>
    <div class="tile">
        <img src="images/main_page_images/tennis_man.png" alt="tennis image">
        <a>Korty tenisowe</a>
    </div>
    <div class="tile">
        <img src="images/main_page_images/basketball.png" alt="basketball image">
        <a>Boiska do koszykówki</a>
    </div>
</div>
<div style="background-color:#28303f;padding-bottom: 100px;"></div>
<script src="scripts/slider.js"></script>
<?php include_once('footer.php'); ?>
