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

    $pageTitle = "Ticketstatus hinzufügen";
    $customCss = "../../css/addEntities.css";
    require_once("../01GeneralHelper/header.php");
    require_once("../02Navbars/navbar.php");

?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-signin flex-row my-5">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Neuen Ticketstatus hinzufügen</h5>
                        <form class="form-signin" action="nda/doAddTicketstatus.php" method="post">

                            <div class="form-label-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Ticketstatus" >
                                <label for="name">Ticketstatus</label>
                            </div>





                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Anlegen</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php

        require_once("../01GeneralHelper/featherIcons.php");
        //require_once("../01GeneralHelper/stickyFooter.php");
        require_once("../01GeneralHelper/bottom.php");

    ?>


