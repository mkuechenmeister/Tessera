<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 14.02.2019
     * Time: 01:07
     */


    require_once("../../01GeneralHelper/init.php");




    /*
    Melder = 1
    Rezeption = 2
    Techniker = 3
    Admin = 4
    */

    if (!$isLoggedIn || $agentgroup < 3) {
        //Keine Berechtigung -> Abbruch ohne Errorcode
        header("Location: ../../../");
    }else {

        $ec = "";

        if (isset($_POST['name'])) {

            $name = trim(htmlspecialchars($_POST['name']));

            if (!empty($name)) {
                require_once("../../../Model/Usergroup.php");

                if (!Usergroup::exists($name)) {
                    Usergroup::createNew($name);
                } else {
                    $ec = "BenutzergruppeVorhanden";
                }
            }
        }



        if (!empty($ec)) {

            header("Location: ../?ec=$ec");
        }else{

            header("Location: ../?success");
        }

    }