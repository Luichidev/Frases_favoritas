<?php
include_once("inc/funciones.php");

function insertUser($name, $email, $pass, $roll){
  $sql = "INSERT INTO users (use_name, use_email, use_pass, use_roll) VALUES('{$name}', '{$email}', '{$pass}', '{$roll}')";
  sendData($sql);
}

function getAllUsers() {
  $sql = "SELECT use_name, use_email, COUNT(idquote) as use_nroQuotes FROM users JOIN quotes ON users.iduser = quotes.quo_iduser WHERE use_name <> 'admin' GROUP BY iduser";
  $res = getData($sql);
  return !empty($res)? $res : [];
}

function getSession($email) {
  $sql = "SELECT iduser, use_pass, use_name, use_roll FROM users WHERE use_email='{$email}'";
  $res = getData($sql);
  return !empty($res)? $res : [];
}

function getQuotes($iduser){
  $sql = "SELECT idquote, quo_quote, quo_author, quo_category, quo_isPublic FROM quotes WHERE quo_iduser = {$iduser}";
  $res = getData($sql);
  return !empty($res)? $res : [];
}

function updateQuotes($id, $url, $description, $checked){
  $sql = "UPDATE quotes SET quo_url = '{$url}', quo_description = '{$description}', quo_isPublic = '{$checked}' WHERE idfavorite = {$id}";
  sendData($sql);
}

function insertQuotes($iduser, $frase, $autor, $categoria, $checked){
  $sql = "INSERT INTO quotes (quo_iduser, quo_quote, quo_author, quo_category, quo_isPublic) VALUES({$iduser}, '{$frase}', '{$autor}', '{$categoria}', {$checked})";
  sendData($sql);

}

function deleteQuotes($id){
  $sql = "DELETE FROM quotes WHERE idquote = {$id}";
  sendData($sql);
}
