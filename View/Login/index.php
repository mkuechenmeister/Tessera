<?php
    require_once("../01GeneralHelper/init.php");

    $pageTitle = "Tessera Interalpen-Hotel Tyrol";
    $customCss = "css/login.css";

    require_once("../01GeneralHelper/header.php")
?>


  <body class="text-center">
    <form class="form-signin" method="post" action="nda/doLogin.php">
      <img class="mb-4" src="../../img/te.svg" alt="" width="300" height="300">
      <h1 class="h2 mb-3 font-weight-normal"><!--<span data-feather="activity"></span>--> melden bearbeiten überwachen</span></h1>
      <label for="username" class="sr-only">Benutzername</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Benutzername" required autofocus>
      <label for="inputPassword" class="sr-only">Passwort</label>
      <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Passwort" required>
      <!--<div class="checkbox mb-3">
      <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      -->

        <button class="btn btn-lg btn-primary btn-block" type="submit">Anmelden</button>
        <!--<button class="btn btn-lg btn-green btn-block">
            <span data-feather="calendar"></span>
            This week
        </button>-->
      <p class="mt-5 mb-3 text-muted">&copy;IT-Kolleg Imst <br><?=date('d.m.Y')?></p>
    </form>

      <?php
          include_once("../01GeneralHelper/featherIcons.php");
          require_once("../01GeneralHelper/bottom.php");
      ?>


