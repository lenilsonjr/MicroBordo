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


/*
This is the main system class. Here we'll deal with everything related to the system.
*/

class MicroBordo {

    //The main site URL
    const BASE_URL = Config::BASE_INSTALATION_URL;

    //The main CSS dir
    const CSS_DIR = "core/front-end/css/";

    //The main JS dir
    const JS_DIR  = "core/front-end/js/";

    //The main img dir
    const IMG_DIR = "core/front-end/images/";


    /*
    Used to AJAX navigation
    RETURN: The URL of the page

    $page: The page to access | DEFAULT: NULL
    */
    public function navPage($page, $p = NULL) {

        if ($p != NULL) {

            $p = '?p=' . $p;

        } else {
            $p = '';
        }

        return "core/pages/content-".$page.".php" . $p;

    }

    /*
    Get the header
    RETURN: Echo the header

    $header: The header to get | DEFAULT: header.php
    */
    public function getHeader($header = NULL) {

        if ($header == NULL) {

            require_once($_SERVER["DOCUMENT_ROOT"] . '/core/pages/header.php');

        } else {

            require_once($_SERVER["DOCUMENT_ROOT"] . '/core/pages/header-' . $header . '.php');

        }

    }

    /*
    Get the footer
    RETURN: Echo the footer

    $footer: The footer to show | DEFAULT: footer.php
    */
    public function getFooter($footer = NULL) {

        if ($footer == NULL) {

            require_once($_SERVER["DOCUMENT_ROOT"] . '/core/pages/footer.php');

        } else {

            require_once($_SERVER["DOCUMENT_ROOT"] . '/core/pages/footer-' . $footer . '.php');

        }

    }

    /*
    Show the current page title
    RETURN: Echo the current page title
    */
    public function pageTitle(){

        echo self::getBusinessName();

    }

    /*
    Show the content of a page
    RETURN: Echo the content page defined

    $content: The content file to show | DEFAULT: content-home.php
    */
    public static function getContent($content = NULL) {

        if ($content == NULL) {

            require_once($_SERVER["DOCUMENT_ROOT"] . '/core/pages/content-home.php');

        } else {

            require_once($_SERVER["DOCUMENT_ROOT"] . '/core/pages/content-' . $content . '.php');

        }

    }

    /*
    Get the business name in the database
    RETURN: The row 'name' in options table
    */
    public static function getBusinessName() {

        $db = new DB;
        $query = $db->runQuery("SELECT value FROM options WHERE name = 'name' LIMIT 1");

        return $query[0][0];

    }

    /*
    Method to update the system options
    RETURN Array(Erro, Message);

    $data: The data to update | DEFAULT: Empty
    */
    public function updateOptions($data) {

        if (!empty($data)) {

            $database = new DB;

            foreach ($data as $k => $v) {

                $query = $database->runQuery("UPDATE options SET value = '".$v."' WHERE name = '".$k."'", true);

            }

            if ($query) {

                $return = array(0, 'Configurações atualizadas com sucesso!');

            } else {

                $return = array(1, 'Ocorreu um erro ao tentar atualizar as configurações!');

            }

        } else {

            $return = array(1, 'Por favor, preencha o formulário!');

        }

        return $return;
    }

    /*
        According to the database, here we'll load all the class that user has access
    */
    public function loadModules() {

        $d = new DB;
        $query = $d-> runQuery("SELECT value FROM options WHERE name = 'modules'");

        //Let's explode to transform each module into a array part
        $query[0][0] = explode(",", $query[0][0]);

        //Now let's union all
        $modules_db = [];
        foreach($query[0][0] as $cat){

            $modules_db[] = $cat;

        }

        foreach ($modules_db as $m){

            require_once($_SERVER["DOCUMENT_ROOT"] . '/core/classes/'.$m.'.class.php');

        }

        return true;
    }
}
?>
