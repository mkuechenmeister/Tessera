<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 10.02.2019
     * Time: 17:17
     */

    session_start();



    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        //letzte aktivität innerhalb von 30minuten
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
    $isLoggedIn = false;
   //$agentgroup = 4; //for Administrative purpose




    if (isset($_SESSION['uID'])) {
        $root = realpath($_SERVER["DOCUMENT_ROOT"]) . "/tessera/"; //Todo:KM Remove @ Rollout

        require_once("$root/Model/User.php");
        $isLoggedIn = true;
        $agent = User::get($_SESSION['uID']);
        $agentgroup = $agent->getUsergroup();

    }