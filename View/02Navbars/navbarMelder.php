<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/tessera">
            <img src="../../img/te.svg"  height="50" width="50" alt="Tessera">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tickets
                    </a>
                    <!-- Tickets-->
                    <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../"><i data-feather="plus" class="featherGreen featherBold"></i>Ticket erstellen</a>
                    </div>



                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?=$agent->getFirstname() . " " . $agent->getLastname();?>
                    </a>
                    <!-- Here's the magic. Add the .animate and .slide-in classes to your .dropdown-menu and you're all set! -->
                    <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../User">Meine Daten</a>
                        <a class="dropdown-item" href="../Help">Hilfe</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../01GeneralHelper/logout.php">Logout</a>
                    </div>



                </li>

        </div>
    </div>
</nav>