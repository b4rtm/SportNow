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
    <a href="reservation_offers.php?sport=1" class="tile">
        <img src="images/main_page_images/football.png" alt="football image">
        <p>Boiska do piłki nożnej</p>
    </a>
    <a href="reservation_offers.php?sport=8" class="tile">
        <img src="images/main_page_images/running.png" alt="running image">
        <p>Bieżnie</p>
    </a>
    <a href="reservation_offers.php?sport=7" class="tile">
        <img src="images/main_page_images/tennis_man.png" alt="tennis image">
        <p>Korty tenisowe</p>
    </a>
    <a href="reservation_offers.php?sport=5" class="tile">
            <img src="images/main_page_images/basketball.png" alt="basketball image">
            <p>Boiska do koszykówki</p>
    </a>
</div>
<div style="background-color:#28303f;padding-bottom: 100px;"></div>
<script src="scripts/slider.js"></script>
<?php include_once('footer.php'); ?>
