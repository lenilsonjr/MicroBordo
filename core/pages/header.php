<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');

$microbordo = new MicroBordo;
$frontend = new FrontEnd;
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php $microbordo->pageTitle(); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="icon" type="image/x-icon" href="<?=MicroBordo::BASE_URL . MicroBordo::IMG_DIR?>favicon.ico" />

        <?php
            $frontend->getStyles();
            $frontend->getScripts();
        ?>

    </head>
    <body>
