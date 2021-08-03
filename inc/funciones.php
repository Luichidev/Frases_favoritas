<?php
/* FUNCIONES 
  Author: @Luichidev
  Web: https://luisalbertoarana.com
  Creation_Date: 27/07/2021
  Revision: 27/07/2021
*/

//PROTOTIPO: String sanitize(String $value)
//DESCRIPCIÓN:  Devuelve un String saneado, es decir, quita elementos 
//              html del String y los espacios en blanco 
//              enviado por parámetros.
function sanitize($value){
  return strip_tags(trim($value));
}

//PROTOTIPO: String today()
//DESCRIPCIÓN:  Devuelve un String con la fecha y hora actual, si le enviás
//              por parámetros la letra "d" te dará solo la fecha actual.
function today($mode=""){
  $res = "";
  if(!$mode)
    $res = date("j/n/Y \- G:i:s");
    // $res = date("j/n/Y \a \l\a\s G:i:s");
  elseif($mode === "d") 
    $res = date("j/n/Y");

  return $res;
}
//PROTOTIPO: Void build_logs(Array $contents)
//DESCRIPCIÓN:  Recibe un array con el contenido del logs
//              y lo crea.
function build_logs($contents, $msg){
  if($link_logs = fopen("logs/session_logs.txt", "a")){
    $line = "[" . today() . "]=>";
    fwrite($link_logs, $line);
    foreach ($contents as $key => $value) {
      $line = "{$key}: {$value} ";
      fwrite($link_logs, $line);
    }
    $line = " {$msg}." . PHP_EOL;
    fwrite($link_logs, $line);
    fclose($link_logs); 
  }
}
//PROTOTIPO: String dump_var(Array $array)
//DESCRIPCIÓN : Devuelve el contenido de un array 
//              formateado para el cliente (navegador)
function dump_var($array) {
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}
//PROTOTIPO: Array getData(String $sql)
//DESCRIPCIÓN : Devuelve los datos solicitados por la sql
function getData($sql) {
  $dblink = conectar();
  $data = [];
  
  if($dblink){
    $resultado = mysqli_query($dblink, $sql);
    if(mysqli_num_rows($resultado)){
      while($fila = mysqli_fetch_assoc($resultado)){
        $data[] = $fila;
      }
      mysqli_free_result($resultado);
    }
    cerrar_conexion($dblink);
  } 
  return $data;
}
//PROTOTIPO: void sendData(String $sql)
//DESCRIPCIÓN : Inserta, actualiza o borra un registro 
//              de la base de datos, si todo fue bien
//              devuelve true
function sendData($sql) {
  $dblink = conectar();
  if($dblink){
    $resultado = mysqli_query($dblink, $sql);
    cerrar_conexion($dblink);
  }  
}

//PROTOTIPO: Source conectar()
//DESCRIPCIÓN : Se conecta a la base de datos, si todo fue bien , devuelve el enlace de la conexión
function conectar() {
  $dbHost = "localhost";
  $dbUser = "luichidev";
  $dbPass = "admin123";
  $dbName = "quotes_db";
  
  $res = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

  if(!mysqli_connect_errno()){
    mysqli_set_charset($res, 'utf8mb4');
    return $res;
  } else {
    echo 'Error de conexión: ', mysqli_connect_error();
    return null;
  }
  
}
//PROTOTIPO: Void cerrar_conexion(Resource $dblink)
//DESCRIPCIÓN : Recibe un enlace a una base de datos y la cierra
function cerrar_conexion($dblink){
  mysqli_close($dblink);
}
//PROTOTIPO: String create_rows(Array $array)
//DESCRIPCIÓN : Recibe un array con las filas a dibujar
//              en la tabla
function create_rows($array){
  $res = "";
  
  if(!empty($array)){
    foreach ($array as $value) {
      $button = "<a href=\"{$_SERVER["PHP_SELF"]}?edit\" class=\"btn success\">✏️</a>" . PHP_EOL;
      $button_del = "<a href=\"{$_SERVER["PHP_SELF"]}?delete={$value["idquote"]}\" class=\"btn danger\">🗑️</a>" . PHP_EOL;
      $res .= "<tr>";
      $res .= "<input type=\"text\" name=\"idQuo\" value=\"{$value["idquote"]}\" hidden>";
      $res .= $value["quo_isPublic"] === "1"
              ? "<td><input type=\"checkbox\" name=\"esPublico\" checked></td>" . PHP_EOL
              : "<td><input type=\"checkbox\" name=\"esPublico\"></td>" . PHP_EOL;
      
      $res .= "<td>" . ucfirst(strtolower($value["quo_quote"])) . "</td>";
      $res .= "<td>" . ucfirst(strtolower($value["quo_author"])) . "</td>";
      $res .= "<td>" . ucfirst(strtolower($value["quo_category"])) . "</td>";
      $res .= "<td>{$button} {$button_del}</td>";
      $res .= "</tr>";
    }
  }
  return $res;
}
//PROTOTIPO: String drawTable(Array $array)
//DESCRIPCIÓN : Recibe un array y dibuja las filas 
//              y columnas de una tabla
function drawTable($array){
  $res = "";
  if(!empty($array)){
    foreach ($array as $column) {
      if($column["use_name"] !== NULL){
        $res .= "<tr>" . PHP_EOL;
        $res .= "<td>{$column["use_name"]}</td>";
        $res .= "<td>{$column["use_email"]}</td>";
        $res .= "<td>{$column["use_nroQuotes"]}</td>";
        $res .= "</tr>" . PHP_EOL;
      } else 
        $res .= "<tr><td colspan=\"3\" >No hay datos<td></tr>";
    }
  }
  return $res;
}
//PROTOTIPO: String getCustomTitle(String $title)
//DESCRIPCIÓN : Recibe un string que será lo que mostrará
//              como titulo.
function getCustomTitle($title){
  return "<div class=\"wrapper\">\n
            <div class=\"bg\"> {$title} </div>\n
            <div class=\"fg\"> {$title} </div>\n
          </div>\n";
}