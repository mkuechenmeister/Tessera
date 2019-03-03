<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 13.02.2019
     * Time: 14:21
     */

    require_once("../../01GeneralHelper/init.php");



    /*
    Melder = 1
    Rezeption = 2
    Techniker = 3
    Admin = 4
    */
   // $isLoggedIn = true;
  //  $agentgroup = 4;

    if (!$isLoggedIn || $agentgroup > 3) {
        //Keine Berechtigung -> Abbruch ohne Errorcode
        header("Location: ../../../");
    }else{

        if (isset($_POST['username'])) {

            $username = htmlspecialchars($_POST['username']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);

            $mail = htmlspecialchars($_POST['mail']);
            if (empty($mail)) {
                $mail = null;
            }
            $department = htmlspecialchars($_POST['department']);
            $usergroup = htmlspecialchars($_POST['usergroup']);
            $userstatus = htmlspecialchars($_POST['userstatus']);
            $pwd = htmlspecialchars($_POST['pwd']);
            $repwd = htmlspecialchars($_POST['repwd']);

            if ($pwd != $pwd) {

                //todo:KM Saubere Passwortvialidierung auch Clientseitig

                header("Location: ../?ec=OOPS");
                exit();

            } else {
                $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
                require_once("../../../Model/User.php");
                User::createNew($department, $firstname, $lastname, $username, $mail, $hashedPassword, $userstatus, $usergroup);
                header("Location: ../");
                exit();

            }
        }

    }