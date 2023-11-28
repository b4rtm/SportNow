
<nav class="navbar">
    <a href="index.php"><img src="images/main_page_images/logo.png" alt="Logo strony" class="logo"></a>
    <ul class="navbar-menu">
        <li class="navbar-item"><a href="reservation_offers.php">Oferta</a></li>
        <li class="navbar-item"><a href="about_us.php">O nas</a></li>
        <li class="navbar-item"><a href="contact.php">Kontakt</a></li>
        <?php
        session_start();
        if (isset($_SESSION['name'])) {
            ?>
            <li class="navbar-item" id="account-menu">
<!--                <svg viewBox="0 0 24 24" width="2em" height="2em" fill="white" aria-labelledby="wish-list-:R3mq:" class="zds-icon RC794g X9n9TI DlJ4rT _5Yd-hZ HlZ_Tf I_qHp3" focusable="false" aria-hidden="false" role="img" data-testid="wishlist"><title id="wish-list-:R3mq:">Wish list</title><path d="M17.488 1.11h-.146a6.552 6.552 0 0 0-5.35 2.81A6.57 6.57 0 0 0 6.62 1.116 6.406 6.406 0 0 0 .09 7.428c0 7.672 11.028 15.028 11.497 15.338a.745.745 0 0 0 .826 0c.47-.31 11.496-7.666 11.496-15.351a6.432 6.432 0 0 0-6.42-6.306zM12 21.228C10.018 19.83 1.59 13.525 1.59 7.442c.05-2.68 2.246-4.826 4.934-4.826h.088c2.058-.005 3.93 1.251 4.684 3.155.226.572 1.168.572 1.394 0 .755-1.907 2.677-3.17 4.69-3.16h.02c2.7-.069 4.96 2.118 5.01 4.817 0 6.089-8.429 12.401-10.41 13.8z"></path></svg>-->
<!--                <svg viewBox="0 0 24 24" width="2em" height="2em" fill="white" aria-labelledby="your-account-:Rimq:" class="zds-icon RC794g X9n9TI DlJ4rT _5Yd-hZ CnXaXt HlZ_Tf I_qHp3" focusable="false" aria-hidden="false" role="img" data-testid="user-account"><title id="your-account-:Rimq:">Your account</title><path d="M21.645 22.866a28.717 28.717 0 0 0-6.46-7.817c-2.322-1.892-4.048-1.892-6.37 0a28.74 28.74 0 0 0-6.46 7.817.75.75 0 0 0 1.294.76 27.264 27.264 0 0 1 6.113-7.413A3.98 3.98 0 0 1 12 15.125a3.81 3.81 0 0 1 2.236 1.088 27.252 27.252 0 0 1 6.115 7.412.75.75 0 1 0 1.294-.76zM12 12.002A6.01 6.01 0 0 0 18.003 6 6.003 6.003 0 1 0 12 12.002zm0-10.505a4.502 4.502 0 1 1 0 9.005 4.502 4.502 0 0 1 0-9.005z"></path></svg>-->
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