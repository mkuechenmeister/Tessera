<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 09.02.2019
     * Time: 23:17
     */
    require_once("../../01GeneralHelper/init.php");

    if (!isset($_POST['username'])){
        header("Location: ../?ec=Unset");
        exit();
    }else{
        $username = trim(htmlspecialchars($_POST['username']));
        $pwd = trim(htmlspecialchars($_POST['pwd']));
    }

    if (empty($pwd) || empty($username)) {
        header("Location: ../?ec=InputError");
        exit();
    }else{

        require_once("../../../Model/User.php");
        $candidate = User::getUserByUsername($username);
        var_dump($candidate);

        if ($candidate != null && $candidate->checkPassword($pwd)) {
            $_SESSION['uID'] = $candidate->getId();
            header("Location: ../../../");
        }else{
           header("Location: ../?ec=ValidationError");
            exit();
        }

    }

    ?>


