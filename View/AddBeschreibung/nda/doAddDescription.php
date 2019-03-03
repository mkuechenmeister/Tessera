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



        if (isset($_POST['was'])) {

            $was = trim(htmlspecialchars($_POST['was']));

            if (!empty($was)) {
                require_once("../../../Model/Was.php");

                if (!Was::exists($was)) {
                    Was::createNew($was);
                } else {
                    $ec = "WasVorhanden";
                }
            }
        }

        if (isset($_POST['wo'])) {

            $wo = trim(htmlspecialchars($_POST['wo']));
            if(!empty($wo)){
            require_once("../../../Model/Wo.php");

            if (!Wo::exists($wo)) {
                Wo::createNew($wo);

            }else{
                $ec = $ec."WoVorhanden";
            }
        }
        }

        if (isset($_POST['warum'])) {

            $warum = trim(htmlspecialchars($_POST['warum']));
            if (!empty($warum)) {


                require_once("../../../Model/Warum.php");

                if (!Warum::exists($warum)) {
                    Warum::createNew($warum);
                } else {
                    $ec = $ec . "WarumVorhanden";
                }
            }
        }


        if (!empty($ec)) {

            header("Location: ../?ec=$ec");
        }else{

            header("Location: ../?success");
        }

    }