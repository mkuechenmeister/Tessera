<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<?php
    require_once("../01GeneralHelper/init.php");


    if (!$isLoggedIn) {
        header("Location: ../../");

    }

    $pageTitle = "Benutzerdaten verwalten";
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
                        <h5 class="card-title text-center">Meine Daten</h5>
                        <form class="form-signin" action="nda/doSignup.php" method="post">

                            <div class="form-label-group">
                                <input type="text" id="inputUserame" name="username" class="form-control" placeholder="Benutzername">
                                <label for="inputUserame"><?=$agent->getUsername();?></label>

                            </div>

                            <div class="form-label-group">
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Vorname">
                                <label for="firstname"><?=$agent->getFirstname();?></label>
                            </div>

                            <div class="form-label-group">
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Nachname">
                                <label for="lastname"><?=$agent->getLastname();?></label>
                            </div>
                            <div class="form-label-group">
                                <input type="email" name="mail" id="inputEmail" class="form-control" placeholder="Email Adresse" >
                                <label for="inputEmail"><?php
                                        if ($agent->getMail() == null) {
                                            $mail = "Keine Emailadresse eingetragen";
                                        }else {
                                            $mail = $agent->getMail();
                                        }
                                        echo $mail;
                                    ?></label>
                            </div>




                            <!--Class department required-->

                            <?php
                                if ($agent->getUsergroup() > 3) {


                                    require_once("../../Model/Department.php");
                                    $allDepts = Department::getAll();
                                    //var_dump($allDepts);
                                    ?>
                                    <div class="form-label-group">
                                        <select name="department" id="department" class="form-control" required>
                                            <option value="Abteilung" disabled selected>Abteilung</option>
                                            //head of Select

                                            <?php
                                                if ($allDepts == null) {

                                                    //todo:KM lass dir was einfallen

                                                } else {
                                                    foreach ($allDepts as $dept):
                                                        ?>
                                                        <option value="<?= $dept->getID(); ?>"><?= $dept->getName(); ?></option>

                                                    <?php
                                                    endforeach;
                                                }
                                            ?>

                                        </select>
                                    </div>


                                    <!--Usergroup required-->

                                    <?php
                                    require_once("../../Model/Usergroup.php");
                                    $allUserGroups = Usergroup::getAll();

                                    ?>

                                    <div class="form-label-group">
                                        <select name="usergroup" id="usergroup" class="form-control" required>
                                            <option value="Benutzergruppe" disabled selected>Benutzergruppe</option>
                                            <?php

                                                if ($allUserGroups == null) {
                                                    //todo:KM Lass dir was einfallen
                                                } else {
                                                    foreach ($allUserGroups as $userGroup):
                                                        ?>
                                                        <option value="<?= $userGroup->getId() ?>"><?= $userGroup->getName(); ?></option>

                                                    <?php
                                                    endforeach;
                                                }
                                            ?>

                                        </select>
                                        <!--
                                        -->
                                    </div>

                                    <!--Userstatus required-->
                                    <?php
                                    require_once("../../Model/Userstatus.php");
                                    $allStatus = Userstatus::getAll();

                                    ?>

                                    <div class="form-label-group">
                                        <select name="userstatus" id="userstatus" class="form-control" required>
                                            <option value="Status" disabled selected>Status</option>

                                            <?php

                                                if ($allStatus == null) {
                                                    //todo:KM Lass dir was einfallen

                                                } else {


                                                    foreach ($allStatus as $userstatus):
                                                        ?>
                                                        <option value="<?= $userstatus->getId(); ?>"><?= $userstatus->getName(); ?></option>

                                                    <?php
                                                    endforeach;

                                                }

                                            ?>

                                        </select>
                                        <!--
                                        -->
                                    </div>

                                    <?php
                                }
                            ?>




                            <hr>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Passwort" required>
                                <label for="inputPassword">Password</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputConfirmPassword" name="repwd" class="form-control" placeholder="Passwort wiederholen" required>
                                <label for="inputConfirmPassword">Passwort wiederholen</label>
                            </div>

                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Update</button>

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