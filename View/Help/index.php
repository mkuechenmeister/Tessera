<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 14.02.2019
     * Time: 01:01
     */

    require_once("../01GeneralHelper/init.php");


    if (!$isLoggedIn) {
        header("Location: ../../");

    }

    $pageTitle = "Hilfe";
    //$customCss = "../../css/addEntities.css";
    require_once("../01GeneralHelper/header.php");
    require_once("../02Navbars/navbar.php");

?>

<header class="bg-primary text-center py-5 mb-4 tessera-blue">
    <div class="container">
        <h1 class="font-weight-light text-white">Hilfe-Seite</h1>
    </div>
</header>



<?php

    require_once("../01GeneralHelper/featherIcons.php");
    //require_once("../01GeneralHelper/stickyFooter.php");
    require_once("../01GeneralHelper/bottom.php");

?>


