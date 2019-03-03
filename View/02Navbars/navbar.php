<?php


    switch ($agentgroup) {
        case 1:
            require_once("navbarMelder.php");
            break;
        case 2:
            require_once("navbarRezeption.php");
            break;
        case 3:
            require_once("navbarTechnik.php");
            break;

        case 4:
            require_once("navbarAdmin.php");
            break;

        default:
            header("Location: ../../");

    }