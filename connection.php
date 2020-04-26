<?php
    function connectToDB() {

      $db_host = 'localhost';
      $db_navn = '';    #bruker
      $db_bruker = '';  #brukernavn
      $db_pass = '';            #passord
    
      $db_forbindelse = mysqli_connect($db_host, $db_bruker, $db_pass, $db_navn);
      
      if (mysqli_connect_errno()) {
        die('Kunne ikke opprette forbindelse med databasen: ' . mysqli_connect_error()) ;
      } else {
        return $db_forbindelse;
      }
    }

?>