<?php
include 'conectarbanco.php';
session_start();
$id = $_SESSION['id_usuario'];
$conexao = new conectarbanco();
$conn = $conexao->conectar();

$sql = "SELECT * FROM treino WHERE id_usuario = $id";
$result = $conn->query($sql);

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM treino WHERE id_treino = $delete_id";
    $conn->query($sql_delete);
    header("Location: treinos.php"); // Redirecionar após excluir
    exit();
}
if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $sql_edit = "SELECT * FROM treino WHERE id_treino = $edit_id";
    $result_edit = $conn->query($sql_edit);
    $treino_edit = mysqli_fetch_array($result_edit);
}



// Processar formulário de adição
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['musculo'];
    $exercicio = $_POST['exercicio'];
    $series = $_POST['series'];
    $repeticoes = $_POST['repeticoes'];
    $observacoes = $_POST['observacoes'];

    $sql = "INSERT INTO treino (id_usuario, musculo, exercicio, series, repeticoes, observacoes) 
        VALUES ('$id', '$nome', '$exercicio', $series, '$repeticoes', '$observacoes')";


    if (mysqli_query($conn, $sql)) {
        header("location: treinos.php");
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
    <title>treinos</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/treinos.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel="shortcut icon" type="imagex/png" href="../imagens/ginastica.ico">
    <!-- Adicione isso na seção head do seu HTML -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>

    <div class="treinos">

        <table>
            <tr>
                <th>Musculos</th>
                <th>Exercício</th>
                <th>Séries</th>
                <th>Repetições</th>
                <th>Observações</th>
                <th>Ações</th>

            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['musculo'] . "</td>";
                echo "<td>" . $row['exercicio'] . "</td>";
                echo "<td>" . $row['series'] . "</td>";
                echo "<td>" . $row['repeticoes'] . "</td>";
                echo "<td>" . $row['observacoes'] . "</td>";
                echo "<td>
    <a href='editTreino.php?id=" . $row['id_treino'] . "' class='btn-edit'><button>Editar</button></a>
    <button class='btn-delete' onclick='confirmDelete(" . $row['id_treino'] . ")'>Excluir</button>
</td>";

                echo "</tr>";
            }
            ?>
        </table>

        <h2 class="titulo">Adicionar Treino</h2>
        <form action="treinos.php" method="post">
            <label for="musculo">Músculos:</label>
            <input type="text" name="musculo" required class="input">

            <label for="exercicio">Exercício:</label>
            <input type="text" name="exercicio" required class="input"><br>

            <label for="series">Séries:</label>
            <input type="number" name="series" required class="input">

            <label for="repeticoes">Repetições:</label>
            <input type="text" name="repeticoes" required class="input">

            <label for="observacoes">Observações:</label>
            <input type="text" name="observacoes" class="input"><br>

            <input type="submit" value="Adicionar Treino" class="enviar">
        </form>
    </div>
    <div class="sidebar">
        <h3 id="nomeUser">Treinos</h3>
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
                var result = confirm("Tem certeza que deseja excluir este treino?");
                if (result) {
                    window.location.href = 'treinos.php?delete_id=' + id;
                }
            }
        </script>

</body>

</html>