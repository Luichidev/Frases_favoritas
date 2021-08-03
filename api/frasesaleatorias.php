<?php 
  header("Content-Type:application/json; charset=utf-8");
  include_once("../inc/funciones.php");

  function getRandQuote(){
    $sql = "SELECT quo_quote, quo_author FROM quotes WHERE quo_isPublic = 1 ORDER BY rand() LIMIT 1";
    $res = getData($sql);
    return !empty($res)? $res : [];
  }
  
  $quotes = getRandQuote();

  echo !empty($quotes)?json_encode($quotes): [];