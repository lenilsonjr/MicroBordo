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
In this class we'll deal with all database related requests, like mysql connections, data insert
and more.
*/

Class DB {

    private static $db = array(
        "base"      => Config::DATABASE_BASE,
        "host"      => Config::DATABASE_HOST,
        "user"      => Config::DATABASE_USER,
        "pass"      => Config::DATABASE_PASS
    );

    /*
    Function to connect to the database

    $base: The database to connect | DEFAULT: $db['base']
    */
    public static function openDB($base = NULL) {

        if ($base == NULL) {

            $base = self::$db['base'];

        }

        global $connection;
        $connection = new PDO('mysql:host='.self::$db['host'].';dbname='.$base.';charset=utf8', self::$db['user'], self::$db['pass']);
    }

    /*
    Function to close the connection with the database

    */
    public static function closeDB() {

        unset($connection);

    }


    /*
    Function to run a query in the database

    $query: The query to run into mysql | DEFAULT: NULL
    $boolean: Do you want a bolean return? True to DELETE or INSERT querys | DEFAULT: FALSE
    */
    public static function runQuery($query = NULL, $boolean = FALSE) {

        self::openDB();
        global $connection;

        try {

            //SQL Injection here? Nope
            $query = $connection->prepare($query);

            if ($boolean == FALSE) {

                $query->execute();
                $return = $query->fetchAll();

            } else {

                $return = $query->execute();

            }

        } catch(PDOException $e) {

            $return = "Um erro foi encontrado ao tentar rodar a query" . $e->getMessage();

        }
        self::closeDB();
        return $return;
    }

    /*
    Function to run a query and count the row number

    $query: The query to run into database | DEFAULT: Empty
    */
    public static function countQuery($query) {

        try {

            //A bit memory ineficient, but i didin't find another way
            $rows = self::runQuery($query);
            $i = 0;
            foreach($rows as $k) {

                $i++;

            }
            $return = $i;


        } catch(PDOException $e) {

            $return = 0;

        }

        return $return;

    }

}
?>
