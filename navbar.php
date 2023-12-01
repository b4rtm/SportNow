
<nav class="navbar">
    <a href="index.php"><img src="images/main_page_images/logo.png" alt="Logo strony" class="logo"></a>
    <ul class="navbar-menu">
        <li class="navbar-item"><a href="reservation_offers.php">Oferta</a></li>
        <li class="navbar-item"><a href="about_us.php">O nas</a></li>
        <li class="navbar-item"><a href="contact.php">Kontakt</a></li>
        <?php
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['name'])) {
            ?>
            <li class="navbar-item" id="account-menu" style="position: relative">
                <svg viewBox="0 0 24 24" width="2em" style="cursor: pointer" height="2em" fill="#23C0E9"><title>Twoje konto</title><path d="M12 3a4.5 4.5 0 00-4.5 4.5H9a3 3 0 013-3V3zM7.5 7.5A4.5 4.5 0 0012 12v-1.5a3 3 0 01-3-3H7.5zM12 12a4.5 4.5 0 004.5-4.5H15a3 3 0 01-3 3V12zm4.5-4.5A4.5 4.5 0 0012 3v1.5a3 3 0 013 3h1.5zM4.5 21v-3H3v3h1.5zm0-3a3 3 0 013-3v-1.5A4.5 4.5 0 003 18h1.5zm3-3h9v-1.5h-9V15zm9 0a3 3 0 013 3H21a4.5 4.5 0 00-4.5-4.5V15zm3 3v3H21v-3h-1.5z"></path></svg>
                <ul class="submenu">
                    <ul><a href="reservation_history.php">Historia rezerwacji</a></ul>
                    <ul><a href="edit_profile.php">Edytuj profil</a></ul>
                    <ul><a href="logout.php">Wyloguj</a></ul>
                </ul>
            </li>
            <a href="favourites.php">
                <svg viewBox="0 0 24 24" width="2em" height="2em" fill="none"><title>Ulubione</title><path stroke="#23C0E9" stroke-width="1.5" d="M16.794 3.75c1.324 0 2.568.516 3.504 1.451a4.96 4.96 0 010 7.008L12 20.508l-8.299-8.299a4.96 4.96 0 010-7.007A4.923 4.923 0 017.205 3.75c1.324 0 2.568.516 3.504 1.451l.76.76.531.531.53-.531.76-.76a4.926 4.926 0 013.504-1.451"></path></svg>
            </a>

        <?php } else { ?>
        <li class="navbar-item"><a href="login.php">Logowanie</a></li>
        <li class="navbar-item"><a href="register.php">Rejestracja</a></li>
        <?php } ?>
    </ul>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const accountMenu = document.getElementById('account-menu');
            const submenu = accountMenu.querySelector('.submenu');

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