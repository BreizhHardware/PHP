<?php
function dbConnect() //fonction de connexion à la base de données
  {
    try
    {
      $db = new PDO('pgsql:host='.DB_SERVER.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $exception)
    {
      error_log('Connection error: '.$exception->getMessage());
      return false;
    }
    return $db;
  }

  function console_log($data)
  {
      //Console Log comme en JS
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
  }
?>