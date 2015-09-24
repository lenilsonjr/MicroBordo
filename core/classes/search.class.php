<?php
/*
    This class deal with search-related actions
*/
class Search extends DB{


    /*
        Function to return the search page to be loaded

        $s: The expression to search for | DEFAULT: Empty
    */
    public function searchPage($s) {

        return 'core/pages/content-search.php?s=' . $s;

    }


    /*
        Function to, in fact, search the data in the database.

        $s: The expression to search for | DEFAULT: Empty
    */
    public function searchString($s) {

        self::openDB();
        global $connection;

        $query = $connection->prepare("");
        $query->execute();
        $return = $query->fetchAll();

        self::closeDB();

        return $return;
    }

}

?>
