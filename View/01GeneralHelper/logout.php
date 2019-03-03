<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 16.02.2019
     * Time: 16:25
     */

    session_start();
    session_unset();
    session_destroy();
    header("Location: ../../");
    exit();