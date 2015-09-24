<?php
/*
    This class was created to centralize the pagination logic
*/
class Pagination {

    /*
        This function return the maximum page that can be show in pagination menu

        RETURN Max page (integer)
        $table : The table to get the max page | DEFAULT : Empty
    */
    public static function getMaxPage($table) {

        $database = new DB;
        $rows = $database->countQuery("SELECT * FROM " . $table);
        $rows = $rows;

        if (($rows % 15) == 0) {

            $return = ($rows / 15);

        } else if (($rows % 15) != 0) {

            $return = ceil($rows / 15);

        }

        return $return;
    }

    /*
        This function returns the OFFSET to use in mysql
        RETURN: $offset (Integer)

        $p: The page where the user is | Default: NULL
    */
    public static function getOffSet($p = NULL) {

        //Let's check if $p is NULL or empty
        if ($p == NULL OR empty($p)) {
            $p = 1;
        }

        //Now we know the offset to use in mysql
        if ($p > 1) {
            $offset = 15 * ($p-1);
        } else {
            $offset = NULL;
        }

        return $offset;
    }


}
?>
