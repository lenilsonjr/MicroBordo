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
