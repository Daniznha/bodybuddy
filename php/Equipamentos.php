<?php

// Incluir arquivo de conexão com o banco de dados
include 'conectarbanco.php';

// Criar uma instância da classe conectarbanco
$conexao = new conectarbanco();

// Conectar ao banco de dados
$conn = $conexao->conectar();

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT * FROM equipamentos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipamentos BodyBuddy</title>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/equipamentos.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" type="imagex/png" href="../imagens/ginastica.ico">
    <style>

    </style>
</head>

<body>
    <main>
        <div class="eq">


            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="equipamentos">
                        <h2><?php echo $row["nome"]; ?></h2><br><br>
                        <img src="../imagens/<?php echo $row["imagem"]; ?>" alt="Imagem do equipamento" width="100%"><br><br>
                        <p><strong>Categoria:</strong> <?php echo $row["categoria"]; ?></p>
                        <p><strong>Função:</strong> <?php echo $row["funcao"]; ?></p>
                        <p><strong>Músculos trabalhados:</strong> <?php echo $row["musculos_trabalhados"]; ?></p>
                        <p><strong>Como usar:</strong> <?php echo $row["como_usar"]; ?></p>

                    </div>
            <?php
                }
            } else {
                echo "Não foram encontrados resultados.";
            }
            ?>
        </div>
    </main>
    <div class="sidebar">
        <h3>Equipamentos</h3>
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
    </div>
    </div>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Fechar conexão
$conn->close();
?>