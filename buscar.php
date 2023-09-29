<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
    <div>
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
          <a class="nav-link " href="cadastrar.php">Cadastrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="alterar.php">Alterar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"  href="buscar.php">Buscar</a>
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
        <?php 
        if (isset($_POST['descricao'])) {
        $conn = mysqli_connect("localhost", "root", "", "banco");
        $descricao = $_POST['descricao'];
        $query = "SELECT * FROM tarefas WHERE descricao LIKE '%$descricao%'";
        $result = mysqli_query($conn, $query);
      
        $tarefas = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
        if ($tarefas) {
          foreach ($tarefas as $tarefa) {
            echo '<p>' . "Tarefa encontrada: ". $tarefa['descricao'] . '</p>';
          }
        } else {
          echo '<p>Não foi possível encontrar nenhuma tarefa com o nome pesquisado!</p>';
        }
      }
      ?>
        <form action="buscar.php" method="POST">
          <span>Digite abaixo a tarefa a ser pesquisada: <br></span>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" id="descricao" name="descricao" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
          </div>
          <button type="submit" class="btn btn-primary">Pesquisar tarefa</button>
        </form>
      </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>