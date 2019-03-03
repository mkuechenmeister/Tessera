<?php

    require_once("View/01GeneralHelper/init.php");

    if (!$isLoggedIn) {

        header("Location: View/Login");

    }else{

        header("Location: View/Dashboard");
    }

?>