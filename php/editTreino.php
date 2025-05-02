<?php
include 'conectarbanco.php';
session_start();
$id = $_SESSION['id_usuario'];
$conexao = new conectarbanco();
$conn = $conexao->conectar();

// Verifique se o ID do treino está presente na URL
if (isset($_GET['id'])) {
    $id_treino = $_GET['id'];

    // Se o formulário de edição foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtenha os dados do formulário
        $nome = $_POST['musculo'];
        $exercicio = $_POST['exercicio'];
        $series = $_POST['series'];
        $repeticoes = $_POST['repeticoes'];
        $carga = $_POST['carga'];
        $observacoes = $_POST['observacoes'];

        // Atualize os dados no banco de dados
        $sql = "UPDATE treino SET musculo='$nome', exercicio='$exercicio', series=$series, repeticoes='$repeticoes', observacoes='$observacoes' WHERE id_treino=$id_treino";

        if (mysqli_query($conn, $sql)) {
            header("location: treinos.php");
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Selecione os detalhes do treino com base no ID
    $sql = "SELECT * FROM treino WHERE id_treino = $id_treino";
    $result = $conn->query($sql);

    // Verifique se há resultados
    if ($result->num_rows > 0) {
        // Obtenha os detalhes do treino
        $row = mysqli_fetch_assoc($result);

        // Exiba o formulário de edição com os detalhes do treino preenchidos
?>
        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Treino</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/treinos.css">
            <link rel="stylesheet" href="../css/style.css">
            <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
            <link rel="shortcut icon" type="imagex/png" href="../imagens/ginastica.ico">
        </head>

        <body>

            <div class="editar-treinos">
                <h2>Editar Treino</h2>

                <form action="" method="post">
                    <label for="musculo">Músculos:</label>
                    <input type="text" name="musculo" value="<?php echo $row['musculo']; ?>" required><br>

                    <label for="exercicio">Exercício:</label>
                    <input type="text" name="exercicio" value="<?php echo $row['exercicio']; ?>" required><br>

                    <label for="series">Séries:</label>
                    <input type="number" name="series" value="<?php echo $row['series']; ?>" required><br>

                    <label for="repeticoes">Repetições:</label>
                    <input type="text" name="repeticoes" value="<?php echo $row['repeticoes']; ?>" required><br>

                    <label for="observacoes">Observações:</label>
                    <input type="text" name="observacoes" value="<?php echo $row['observacoes']; ?>"><br><br>

                    <input type="submit" value="Atualizar Treino" class="enviar">
                </form>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "Treino não encontrado.";
    }
} else {
    echo "ID do treino não fornecido.";
}

mysqli_close($conn);
?>