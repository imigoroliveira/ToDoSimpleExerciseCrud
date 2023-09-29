<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<script>
  function excluirTarefa(id){
    window.location.href = window.location.href + "?id=" + encodeURIComponent(id);
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
          <a class="nav-link"  href="alterar.php">Alterar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link "  href="buscar.php">Buscar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"  href="excluir.php">Excluir</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    </div>
    <div class="bod">
        <?php 
          $conn = mysqli_connect("localhost", "root", "", "banco");

          if (isset($_POST['excluir_id'])) {
            $excluir_id = $_POST['excluir_id'];
              $excluir_id = intval($_POST['excluir_id']);
              $query = "DELETE FROM tarefas WHERE id = $excluir_id;";   
              $result = mysqli_query($conn, $query);
              if(mysqli_affected_rows($conn)>0) {
                ?> 
                <script> alert("Tarefa excluida com sucesso!");</script><?php
              }
              else{ ?>
                <script> alert("Não foi possivel excluir tarefa!");</script><?php
              }   

          }

          $sql = "SELECT id, descricao, nivel FROM tarefas";
          $result = mysqli_query($conn, $sql);
          
          if (mysqli_num_rows($result) > 0) {
              echo '<table class="table" border="1">';
              echo '<tr><th>ID</th><th>Descrição</th><th>Nível</th><th>Excluir</th></tr>';
              
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>' . $row["id"] . '</td>';
                  echo '<td>' . $row["descricao"] . '</td>';
                  echo '<td>' . $row["nivel"] . '</td>';
                  echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
                  echo '<input type="hidden" name="excluir_id" value="' . $row["id"] . '">';
                  echo '<td><button type="submit">Excluir</button></td>';
                  echo '</tr>';
                  echo '';
                  }

              echo '</table>';
          } else {
              echo '<p>Nenhuma tarefa encontrada.</p>';
          }
        ?>      
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


