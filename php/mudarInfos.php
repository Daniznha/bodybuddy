<?php
include 'conectarbanco.php';
session_start();
$id = $_SESSION['id_usuario'];
$conexao = new conectarbanco();
$conn = $conexao->conectar();

// Verifique se o ID do treino está presente na URL
if (isset($_GET['id'])) {
    $id_infos = $_GET['id'];

    // Se o formulário de edição foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $altura = $_POST['altura'];
        $peso = $_POST['peso'];
        $cintura = $_POST['cintura'];
        $gluteo = $_POST['gluteo'];
        $busto = $_POST['busto'];

        // Atualize os dados no banco de dados
        $sql = "UPDATE infos SET altura='$altura', peso='$peso', cintura='$cintura', gluteo='$gluteo', busto='$busto' WHERE id_infos=$id_infos";

        if (mysqli_query($conn, $sql)) {
            header("location: infos.php");
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Selecione os detalhes do treino com base no ID
    $sql = "SELECT * FROM infos WHERE id_infos = $id_infos";
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
            <div class="editar-infos">
                <h2>Editar Informações</h2>
                <form action="" method="post">


                    <label for="altura">Altura:</label>
                    <input type="text" name="altura" value="<?php echo $row['altura']; ?>" required><br>

                    <label for="peso">Peso:</label>
                    <input type="text" name="peso" value="<?php echo $row['peso']; ?>" required><br>

                    <label for="busto">Busto:</label>
                    <input type="text" name="busto" value="<?php echo $row['busto']; ?>" required><br>

                    <label for="cintura">Cintura:</label>
                    <input type="text" name="cintura" value="<?php echo $row['cintura']; ?>" required><br>

                    <label for="gluteo">Glúteos:</label>
                    <input type="text" name="gluteo" value="<?php echo $row['gluteo']; ?>" required><br>


                    <input type="submit" value="Atualizar informações" class="enviar">
                </form>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "Informação não encontrada.";
    }
} else {
    echo "ID da informação não fornecido.";
}

mysqli_close($conn);
?>