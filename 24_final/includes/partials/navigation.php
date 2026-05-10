<header>
    <nav class="navbar bg-dark border-bottom border-body navbar-expand-lg " data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">MusicBoxx</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?site=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?site=about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?site=services">Services</a>
                    </li>

                    <?php if (isAdmin()): ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Genres
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="index.php?site=create-genre">Bearbeiten</a>
                                </li>
                            </ul>
                        </li>

                    <?php endif; ?>


                    <li class="nav-item">
                        <a class="nav-link" href="index.php?site=create-station">Create Station</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?site=show-stations">Show Station</a>
                    </li>



                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?site=logout">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?site=register">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?site=login">Login</a>
                        </li>
                    <?php endif; ?>

                </ul>




            </div>
        </div>
    </nav>







</header>