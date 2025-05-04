<?php
include 'conectarbanco.php';
session_start();
$id = $_SESSION['id_usuario'];
$conexao = new conectarbanco();
$conn = $conexao->conectar();

// Verifique se o ID do treino está presente na URL
if (isset($_GET['id'])) {
    $id_metas = $_GET['id'];

    // Se o formulário de edição foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST['data'];
        $objetivo = $_POST['objetivo'];
        $dt_alvo = $_POST['data-alvo'];


        // Atualize os dados no banco de dados
        $sql = "UPDATE metas SET objetivo='$objetivo', dt_alvo='$dt_alvo' WHERE id_metas=$id_metas";

        if (mysqli_query($conn, $sql)) {
            header("location: index.php");
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Selecione os detalhes do treino com base no ID
    $sql = "SELECT * FROM metas WHERE id_metas = $id_metas";
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
            <title>Editar Informações</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/treinos.css">
            <link rel="stylesheet" href="../css/style.css">
            <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
            <link rel="shortcut icon" type="imagex/png" href="../imagens/ginastica.ico">
        </head>

        <body>
            <div class="editar-metas">
                <h2>Editar Metas</h2>
                <form action="" method="post">

                    <label for="objetivo">Objetivo:</label>
                    <input type="text" name="objetivo" value="<?php echo $row['objetivo']; ?>" required><br>

                    <label for="data-alvo">Data Alvo:</label>
                    <input type="date" name="data-alvo" value="<?php echo $row['dt_alvo']; ?>" required><br>


                    <input type="submit" value="Atualizar Metas" class="enviar">
                </form>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "Meta não encontrada.";
    }
} else {
    echo "ID da meta não fornecido.";
}

mysqli_close($conn);
?>