<?php

require 'conexao.php';
$acao = $_POST['acao'];

if($acao == "CarregaGrind"){
    $query_select = "SELECT * FROM tasks";
    $select = mysqli_query($connect,$query_select);
    $array = mysqli_fetch_all($select);
    echo json_encode($array);
}

if($acao == "CompletaTask"){
  $id = $_POST['id'];
  $query_select = "SELECT * FROM tasks WHERE id = '$id'";
  $select = mysqli_query($connect,$query_select);
  $tasks = mysqli_fetch_object($select);
  if($tasks->completa == "1"){
    $completa = "0";
  }else{
    $completa = "1";
  }

  $query = "UPDATE tasks SET completa = '$completa' WHERE id = $id";
  $update = mysqli_query($connect,$query);
  if($update){
    $menssagem="Taks completa com sucesso!";
  }else{
    $menssagem="Não foi possível completar essa task";
  }
  echo json_encode($menssagem);
}

if($acao == "AdicionaTask"){
  $tasks = $_POST['tasks'];
  $query = "INSERT INTO tasks (nome) VALUES ('$tasks')";
  $insert = mysqli_query($connect,$query);

  if($insert){
    $menssagem="Taks adicionada com sucesso!";
  }else{
    $menssagem="Não foi possível adicionar essa task";
  }
  echo json_encode($menssagem);
}

if($acao == "DeletaTask"){
  $id = $_POST['id'];
  $query = "DELETE FROM tasks WHERE id = '$id'";
  $delete = mysqli_query($connect,$query);

  if($delete){
    $menssagem="Taks apagada com sucesso!";
  }else{
    $menssagem="Não foi possível apagada essa task";
  }
  echo json_encode($menssagem);
}
?>