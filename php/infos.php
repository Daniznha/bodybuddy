<?php
include 'conectarbanco.php';
session_start();
$id = $_SESSION['id_usuario'];
$conexao = new conectarbanco();
$conn = $conexao->conectar();

$sql = "SELECT * FROM infos WHERE id_usuario = $id";
$result = $conn->query($sql);

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM infos WHERE id_infos = $delete_id";
    $conn->query($sql_delete);
    header("Location: infos.php"); // Redirecionar após excluir
    exit();
}
if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $sql_edit = "SELECT * FROM infos WHERE id_infos = $edit_id";
    $result_edit = $conn->query($sql_edit);
    $treino_edit = mysqli_fetch_array($result_edit);
}




// Processar formulário de adição
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $cintura = $_POST['cintura'];
    $gluteo = $_POST['gluteo'];
    $busto = $_POST['busto'];
    

    $sql = "INSERT INTO infos (id_usuario, altura, peso, cintura, gluteo, busto, data_info) 
        VALUES ('$id', '$altura', '$peso', '$cintura', '$gluteo', '$busto', '$data')";

    if (mysqli_query($conn, $sql)) {
        header("location: infos.php");
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);


?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Informações</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/treinos.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel="shortcut icon" type="imagex/png" href="../imagens/ginastica.ico">                      
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>

<div class="infos">

<table>
    <tr>
        <th>Data</th>
        <th>altura(CM)</th>
        <th>peso</th>
        <th>Busto(CM)</th>
        <th>Cintura(CM)</th>
        <th>Glúteos(CM)</th>
        <th>Ações</th>
 
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . date('d/m/Y', strtotime($row['data_info'])) . "</td>";
        echo "<td>" . $row['altura'] . "</td>";
        echo "<td>" . $row['peso'] . "</td>";  
        echo "<td>" . $row['busto'] . "</td>";
        echo "<td>" . $row['cintura'] . "</td>";      
        echo "<td>" . $row['gluteo'] . "</td>";
        echo "<td>
    <a href='mudarInfos.php?id=" . $row['id_infos'] . "' class='btn-edit'><button>Editar</button></a>
    <button class='btn-delete' onclick='confirmDelete(" . $row['id_infos'] . ")'>Excluir</button>
</td>";

        echo "</tr>";
    }
    ?>
</table>

<h2 class="titulo">Adicionar Informação</h2>
<form action="infos.php" method="post">
<label for="data">Data:</label>
    <input type="date" name="data" class="input">

    <label for="altura">Altura:</label>
    <input type="text" name="altura" class="input" ><br>
    
    <label for="peso">Peso:</label>
    <input type="text" name="peso"  class="input">
    
    <label for="busto">Busto(CM):</label>
    <input type="text" name="busto" class="input"><br>
    
    <label for="cintura">Cintura(CM):</label>
    <input type="text" name="cintura" class="input">
    
    <label for="gluteo">Glúteos(CM):</label>
    <input type="text" name="gluteo" class="input"><br>
    
    
    <input type="submit" value="Adicionar Informação" class="enviar">
</form>
</div>
<div class="sidebar">
        
        <h3 id="nomeUser">Informações</h3>
        <ul class="topicos">
            <li class="li"><a href="./index.php">Início</a></li>
            <li class="li"><a href="./infos.php">Minhas informações</a></li>
            <li class="li"><a href="./treinos.php">Meus treinos</a></li>
            <li class="li"><a href="./equipamentos.php">Equipamentos</a></li>
            
            <li class="li">Exercícios
                <ul>
                    <li><a href="./academia.php">Academia</a></li>
                    <li><a href="./arLivre.php">Ar Livre</a></li>
                </ul>
            </li>
        </ul>
        <footer class="footer"> <br>
            <a href=""><i class="fi fi-brands-instagram"></i></a>
            <a href=""><i class="fi fi-brands-facebook"></i></a>
            <a href=""><i class="fi fi-brands-twitter"></i></a>
            <br>&copyBodyBuddy 2023
        </footer>
<script>
    function confirmDelete(id) {
        var result = confirm("Tem certeza que deseja excluir essas informações?");
        if (result) {
            window.location.href = 'infos.php?delete_id=' + id;
        }
    }
</script>

</body>
</html>

