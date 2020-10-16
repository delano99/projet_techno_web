<?php 

  $user = 'root';
  $pass = '';

  try{
    $db = new PDO ('mysql:host=localhost;dbname=projettechweb', $user, $pass);
  }
  catch (PDOException $e) {
    print "Erreur :". $e->getMessage() . "<br/>";
    die;
  }

?>