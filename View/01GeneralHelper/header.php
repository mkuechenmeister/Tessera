
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tessera Ticketsystem">
    <meta name="author" content="Ott|Kuechenmeister|Sima">
    <link rel="icon" href="../../img/favicon.svg">

    <title><?=$pageTitle?></title>


<!--    <script src="/tessera/js/jquery-3.3.1.min.js"></script>-->
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/bootstrap.js"></script>
<!--    <script src="/tessera/js/bootstrap.js"></script>-->

    <!--     //<script src="../../js/jquery-3.3.1.slim.min.js"></script>-->

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <link href="../../css/generalSettings.css" rel="stylesheet">
    <link href="../../css/navbar.css" rel="stylesheet">
    <link href="../../css/stickyFooter.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <?php
        if (isset($customCss)) {
            ?>

            <link href="<?= $customCss;?>" rel="stylesheet">
            <?php
        }
    ?>
</head>