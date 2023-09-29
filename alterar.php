<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar</title>
    <link rel="stylesheet" href="./css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<script>
  function changeId(id){
    document.getElementById("id").value = id;
  }
</script>
<body>
    <div class="menu">
    <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ToDoTasks</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="painel.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cadastrar.php">Cadastrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"  href="alterar.php">Alterar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="alterar.php">Buscar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="excluir.php">Excluir</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    </div>
    <div class="body">
      <form action="alterar.php" method="POST">
        <?php 
            $conn = mysqli_connect("localhost", "root", "", "banco");
            $result = mysqli_query($conn, "SELECT id, descricao FROM tarefas");
            $optionsDescricao = ""; 
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            foreach ($rows as $row) {
              $optionsDescricao .= '<option value="'.$row['id'].'">'."Tarefa: ".$row['descricao'].' , '."Id: ". $row['id'].'</option>';
            }

            if (mysqli_num_rows($result) === 0) {
              echo '<p>Nenhuma task encntrada.</p>';
            }            
            mysqli_close($conn);
            echo '<span>Selecione abaixo a tarefa a ser alterada: <br></span>';
            echo '<select class="form-select mb-4" name="descricao" value="descricao" id="descricao" onchange="changeId(this.value)"> ' . $optionsDescricao . '</select>';
        ?>
       <span>Digite abaixo a nova descricao da tarefa: <br></span>
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control" id="descricao" name="descricao" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <br>
        <input type="hidden" name="id" id="id" value="0">
        <span>Selecione abaixo o novo nivel da tarefa: <br></span>
        
        <select class="form-select mb-4" name="nivel" id="nivel" aria-label="Default select example">
          <option selected>Nivel da tarefa</option>
          <option value="1">Nivel 1 - Facil</option>
          <option value="2">Nivel 2 - Medio</option>
          <option value="3">Nivel 3 - Dificil</option>
        </select>

        <button type="submit" class="btn btn-primary">Alterar tarefa</button>
      </form>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>




<?php

  $conn = mysqli_connect("localhost", "root", "", "banco");
      
  if(!$conn){
    die("Falha na conexao: " . mysqli_connect_error());
  }
  if(!empty($_POST['descricao']) && !empty($_POST['nivel'])) {
    $id = intval($_POST['id']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $nivel = mysqli_real_escape_string($conn, $_POST['nivel']);
    
    $query = "UPDATE tarefas SET descricao = '$descricao',  nivel = '$nivel' WHERE id = $id;";   
    $result = mysqli_query($conn, $query);
    if(mysqli_affected_rows($conn)>0) {
      ?> 
      <script> alert("Tarefa alterada com sucesso!");</script><?php
    }
    else{ ?>
      <script> alert("Não foi possivel alterar tarefa!");</script><?php
    }   
  }
?>
