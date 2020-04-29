<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?= SITE_PATH; ?>">Start PAI</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_PATH; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_PATH; ?>about/">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_PATH; ?>contact/">Kontakt</a>
                </li>

                <?php if (isset($_SESSION["user"])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_PATH; ?>user/logout">Wyloguj <?= $_SESSION["user"]->Surname; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_PATH; ?>post/addNewPost">Dodaj post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_PATH; ?>user/managementSingleUserData">Zarządzaj swoimi danymi</a>
                    </li>
          
                    <?php if ($_SESSION["user"]->Login=='Admin') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_PATH; ?>user/usersManagement">Zarządzaj Użytkownikami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_PATH; ?>log/showAllLogs">Zobacz Logi</a>
                        </li>
                    <?php endif; ?>

                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_PATH; ?>user/login">Logowanie</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_PATH; ?>user/register">Rejstracja</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>