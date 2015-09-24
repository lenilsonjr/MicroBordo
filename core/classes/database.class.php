<?php
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
