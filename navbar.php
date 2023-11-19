


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
            <li class="navbar-item" id="account-menu">
                <a href="#">Twoje konto</a>
                <ul class="submenu">
                    <ul><a href="reservation_history.php">Historia rezerwacji</a></ul>
                    <ul><a href="edit_profile.php">Edytuj profil</a></ul>
                    <ul><a href="logout.php">Wyloguj</a></ul>
                </ul>
            </li>

        <?php } else { ?>
        <li class="navbar-item"><a href="login.php">Logowanie</a></li>
        <li class="navbar-item"><a href="register.php">Rejestracja</a></li>
        <?php } ?>
    </ul>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var accountMenu = document.getElementById('account-menu');
            var submenu = accountMenu.querySelector('.submenu');

            accountMenu.addEventListener('click', function (event) {
                // event.stopPropagation(); // Zapobiega rozprzestrzenianiu się kliknięcia na elementy nadrzędne
                submenu.classList.toggle('show-submenu');
            });

            // Zamknij submenu po kliknięciu poza nim
            document.addEventListener('click', function (event) {
                if (!accountMenu.contains(event.target)) {
                    submenu.classList.remove('show-submenu');
                }
            });
        });
    </script>
</nav>