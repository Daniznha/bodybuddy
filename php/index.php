<?php
include 'conectarbanco.php';
session_start();
$id = $_SESSION['id_usuario'];
$conexao = new conectarbanco();
$conn = $conexao->conectar();

$sql = "SELECT * FROM usuarios where id_usuario = '$id'";
$result = $conn->query($sql);

while ($row = mysqli_fetch_assoc($result)) {
    $nome = $row['nome'];
    $sexo = $row['sexo'];
}
$sql = "SELECT * FROM metas where id_usuario = '$id'";
$result = $conn->query($sql);

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM metas WHERE id_metas = $delete_id";
    $conn->query($sql_delete);
    header("Location: index.php"); // Redirecionar após excluir
    exit();
}
if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $sql_edit = "SELECT * FROM metas WHERE id_metas = $edit_id";
    $result_edit = $conn->query($sql_edit);
    $treino_edit = mysqli_fetch_array($result_edit);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
    $objetivo = $_POST['objetivo'];
    $dt_alvo = $_POST['data-alvo'];

    $stmt = $conn->prepare("INSERT INTO metas (id_usuario, dt_atual, objetivo, dt_alvo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $data, $objetivo, $dt_alvo);

    $id = $_SESSION['id_usuario'];

    if ($stmt->execute()) {
        header("location: index.php");
    } else {
        echo "Erro ao adicionar meta.";
        error_log("Erro SQL: " . $stmt->error);
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BodyBuddy</title>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/treinos.css">
    <link rel="shortcut icon" type="imagex/png" href="../imagens/ginastica.ico">

</head>

<body>

    <main>
        <div class="content">

            <div class="cronometro">
                
                <div id="timer">00:00:00.000</div>
                <button id="startStop">Iniciar</button>
                <button id="reset">Resetar</button>
                <button id="save">Salvar tempo</button>
                <button id="clear">Limpar tempo</button>
                <ul id="savedTimes"></ul>
            </div>
            <hr>
            <div id="frases"></div>
            <div style="clear:both;"></div>
            <hr>
            <div class="metas">
                <table>
                    <tr>
                        <th>Data</th>
                        <th>Objetivo</th>
                        <th>Data Alvo</th>
                        <th>Ações</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . date('d/m/Y', strtotime($row['dt_atual'])) . "</td>";
                        echo "<td>" . $row['objetivo'] . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($row['dt_alvo'])) . "</td>";
                        echo "<td>
                                 <a href='editar-metas.php?id=" . $row['id_metas'] . "' class='btn-edit'><button>Editar</button></a>
                                <button class='btn-delete' onclick='confirmDelete(" . $row['id_metas'] . ")'>Excluir</button>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <h4 class="titulo">Adicionar Metas</h4>
                <form action="index.php" method="post">
                    <label for="data">Data:</label>
                    <input type="date" name="data" required class="input">
                    <label for="objetivo">Objetivo:</label>
                    <input type="text" name="objetivo" required class="input" placeholder="">
                    <label for="data-alvo">Data alvo:</label>
                    <input type="date" name="data-alvo" required class="input">

                    <input type="submit" value="Adicionar Meta" class="enviar">

                </form>

            </div>
        </div>

    </main>
    <div class="sidebar">
        
        <h3 id="nomeUser">Bem vind<?php if ($sexo == "feminino") {
                                        echo "a";
                                    } else {
                                        echo "o";
                                    } ?> ao BodyBuddy, <?php echo $nome ?></h3>
        <ul class="topicos">
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
        <footer> <br>
            <a href=""><i class="fi fi-brands-instagram"></i></a>
            <a href=""><i class="fi fi-brands-facebook"></i></a>
            <a href=""><i class="fi fi-brands-twitter"></i></a>
            <br>&copyBodyBuddy 2023
        </footer>
    </div>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/cronometro.js"></script>
    <script src="../js/frases.js"></script>
    <script>
        function confirmDelete(id) {
            var result = confirm("Tem certeza que deseja excluir esta meta?");
            if (result) {
                window.location.href = 'index.php?delete_id=' + id;
            }
        }
    </script>
</body>


</html>