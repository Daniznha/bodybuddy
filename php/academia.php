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
$sql = "SELECT * FROM exercicios where tipo = 'academia'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia BodyBuddy</title>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/equipamentos.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" type="imagex/png" href="../imagens/ginastica.ico">
    <style>
        /* Seu estilo aqui */
    </style>
</head>

<body>
    <main>
        <div class="eq">        
            <?php
            if ($result->num_rows > 0) {
                // Exibir os dados
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="exercicios">
                        <h2><?php echo $row["nome"]; ?></h2>
                        <img src="../imagens/<?php echo $row["imagem"]; ?>" alt="Imagem do exercício" width="100%"><br>
                        <p><strong>Descrição:</strong> <?php echo $row["descricao"]; ?></p><br>
                        <p><strong>Músculos trabalhados:</strong> <?php echo $row["musculos_trabalhados"]; ?></p><br>
                        <p><strong>Instruções:</strong> <?php echo $row["instrucoes"]; ?></p><br>
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
        <h3>Exercícios academia</h3>
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
        <footer class="footer1"> <br>
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

$conn->close();
?>