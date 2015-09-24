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

        $query = $connection->prepare(" SELECT id, name FROM customers WHERE

                                        id LIKE '".$s."%' OR
                                        name LIKE '".$s."%' OR
                                        email LIKE '".$s."%' OR
                                        phone LIKE '".$s."%' OR
                                        address LIKE '".$s."%' OR
                                        complement LIKE '".$s."%' OR
                                        cep LIKE '".$s."%' OR
                                        idnumber LIKE '".$s."%'

                                        UNION ALL

                                        SELECT id, name FROM products WHERE
                                        id LIKE '".$s."%' OR
                                        name LIKE '".$s."%' OR
                                        ref LIKE '".$s."%'

                                        UNION ALL

                                        SELECT id, name FROM products_categories WHERE
                                        id LIKE '".$s."%' OR
                                        name LIKE '".$s."%'

                                        UNION ALL

                                        SELECT id, name FROM products_taxes WHERE
                                        id LIKE '".$s."%' OR
                                        name LIKE '".$s."%' OR
                                        value LIKE '".$s."%'

                                        UNION ALL

                                        SELECT id, name FROM products_suppliers WHERE
                                        id LIKE '".$s."%' OR
                                        name LIKE '".$s."%' OR
                                        email LIKE '".$s."%' OR
                                        phone LIKE '".$s."%'

                                        UNION ALL

                                        SELECT id, name FROM users WHERE
                                        id LIKE '".$s."%' OR
                                        name LIKE '".$s."%' OR
                                        email LIKE '".$s."%'
                                        ");
        $query->execute();
        $return = $query->fetchAll();

        self::closeDB();

        return $return;
    }

}

?>
