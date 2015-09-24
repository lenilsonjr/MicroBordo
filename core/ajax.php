<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' OR !empty($_GET['action'])) {

    switch ($_GET['action']) {

        case 'nav':
            $p = (empty($_POST['p'])) ? '' : $_POST['p'];
            $microbordo = new MicroBordo;
            $return = $microbordo->navPage($_POST['page'], $p);
            break;

        case 'pag':
            $microbordo = new MicroBordo;
            $return = $microbordo->navPage($_POST['page'], $_POST['p']);
            break;

        case 'search':
            $search = new Search;
            $return = $search->searchPage($_POST['s']);
            break;

        case 'updateOptions':
            $gf = new MicroBordo;
            $return = $gf->updateOptions($_POST);
            break;

        /*
            Actions designed to posts
        */
        case 'viewPost':
            $p = new Posts;
            $return = $p->_view($_POST['id']);
            break;

        case 'newPost':
            $p = new Posts;
            $return = $p->_add($_POST);
            break;

        /*
            End of actions designed to posts
        */

        default:
            $return = array(1, 'Nenhuma ação foi especificada, o que você está tentando fazer?');
            break;

    }

    echo json_encode($return);
}
?>
