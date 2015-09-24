<?php
/*
Copyright (C) 2015  Lenilson Jr.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/


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
