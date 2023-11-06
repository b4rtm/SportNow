


<nav class="navbar">
    <a href="index.php"><img src="images/main_page_images/logo.png" alt="Logo strony" class="logo"></a>
    <ul class="navbar-menu">
        <li class="navbar-item"><a href="reservation_offers.php">Oferta</a></li>
        <li class="navbar-item"><a href="#">O nas</a></li>
        <li class="navbar-item"><a href="#">Kontakt</a></li>
        <?php
        session_start();
        if (isset($_SESSION['name'])) {
            ?>
            <li class="navbar-item"><span>Zalogowany jako: <?= $_SESSION['name'] . ' ' . $_SESSION['surname']; ?></span></li>
            <li class="navbar-item"><a href="logout.php">Wyloguj</a></li>
        <?php } else { ?>
        <li class="navbar-item"><a href="login.php">Logowanie</a></li>
        <li class="navbar-item"><a href="register.php">Rejestracja</a></li>
        <?php } ?>
    </ul>
</nav>