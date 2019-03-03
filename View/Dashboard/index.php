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

    $pageTitle = "Mein Dashboard";
    //$customCss = "../../css/dashboard.css";
    require_once("../01GeneralHelper/header.php");
    require_once("../02Navbars/navbar.php");

?>


<!-- Header -->
<header class="bg-primary text-center py-5 mb-4 tessera-blue">
    <div class="container">
        <h1 class="font-weight-light text-white">Ticketsystem Interalpen-Hotel Tyrol</h1>
    </div>
</header>


<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Team Member 1 -->


        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-0 shadow">
                <img src="../../img/ialpe.png" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <h5 class="card-title mb-0">Interalpen-Hotel Tyrol</h5>
                    <div class="card-text text-black-50">Projektpartner</div>
                </div>
            </div>
        </div>
        <!-- Team Member 2 -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-0 shadow">
                <img src="../../img/itk.png" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <h5 class="card-title mb-0">IT-Kolleg Imst</h5>
                    <div class="card-text text-black-50">Projekbetreuung</div>
                    <div class="card-text text-black-50"></div>
                </div>
            </div>
        </div>


</div>
<!-- /.container -->

    <?php

        require_once("../01GeneralHelper/featherIcons.php");
        //require_once("../01GeneralHelper/stickyFooter.php");
        require_once("../01GeneralHelper/bottom.php");

    ?>


