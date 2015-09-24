<?php
/*
In this class we'll set the front-end tools to be loaded on the pages.
*/

Class FrontEnd {

    /*
    Function to include all CSS files

    $type: The collection of files to open | DEFAULT: The main front-end files
    */
    public function getStyles($type = NULL) {

        $fullDir = MicroBordo::BASE_URL . MicroBordo::CSS_DIR;

        if ($type == NULL) {

            $files = array(
                //"calc.css",
                "bootstrap.min.css",
                //"jasny-bootstrap.min.css",
                "font-awesome.min.css",
                "bootstrap-tags.css",
                //"bootstrap-multiselect.css",
                //"roboto.min.css",
                //"material-fullpalette.min.css",
                //"ripples.min.css",
                //"morris.css",
                "style.css"
            );

        } elseif ($type == 'login') {

            $files = array(
                "bootstrap.min.css",
                "roboto.min.css",
                "material-fullpalette.min.css",
                "ripples.min.css",
                "style-login.css"
            );

        }

        foreach($files as $k => $v) {

            $tag = "<link type=\"text/css\" rel=\"stylesheet\" href=\"". $fullDir . $v ."\" />\n";
            echo $tag;

        }

    }

    /*
    Function to include all JS files

    $type: The collection of files to open | DEFAULT: The main front-end files
    */
    public function getScripts($type = NULL) {

        $fullDir = MicroBordo::BASE_URL . MicroBordo::JS_DIR;

        if ($type == NULL) {

            $files = array(
                "jquery.min.js",
                "bootstrap.min.js",
                "bootstrap-tags.js",
                //"jasny-bootstrap.min.js",
                "scripts.js",
                //"bootstrap-multiselect.js",
                //"ripples.min.js",
                //"material.min.js",
                //"raphael.min.js",
                //"morris.min.js"
            );

        } elseif ($type == 'login') {

            $files = array(
                "jquery.min.js",
                "bootstrap.min.js",
                "ripples.min.js",
                "material.min.js",
                "scripts-login.js"
            );

        }

        foreach($files as $k => $v) {

            $tag = "<script type=\"text/javascript\" src =\"". $fullDir . $v ."\"></script>\n";
            echo $tag;

        }

    }

}
?>
