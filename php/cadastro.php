<?php
include 'conectarbanco.php';
$conexao = new conectarbanco();
$conn = $conexao->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $dt_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    // Usar prepared statements para evitar SQL injection
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, dt_nascimento, sexo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $email, $senha, $dt_nascimento, $sexo);

    if ($stmt->execute()) {
        $mensagem = "Usuário cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar usuário: " . $stmt->error;
    }

    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro BodyBuddy</title>
    
    <link rel="shortcut icon" type="imagex/png" href="../imagens/ginastica.ico">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login-cadastro.css">
</head>

<body>
<div class="container">
        <div class="heading">Cadastro BodyBuddy</div><br>
        <div class="mensagem-cad">
            <?php if (isset($mensagem)) : ?>
                <p><?php echo $mensagem; ?></p>
            <?php endif; ?>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" id="nome" name="nome" required class="input" placeholder="Nome"><br><br>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required class="input"><br><br>


            <label for="sexo">Gênero:</label>
            <div class="radio-inputs">
                <label class="radio">
                    <input type="radio" name="sexo" value="Feminino">
                    <span class="name">Feminino</span>
                </label>
                <label class="radio">
                    <input type="radio" name="sexo" value="Masculino">
                    <span class="name">Masculino</span>
                </label>
                <label class="radio">
                    <input type="radio" name="sexo" value="Outro">
                    <span class="name">Outro</span>
                </label>
            </div><br>

            <input type="email" id="email" name="email" required class="input" placeholder="E-mail"><br><br>

            <input type="password" id="senha" name="senha" required class="input" placeholder="Senha"><br><br>

            <input class="login-button" type="submit" value="Cadastrar">
        </form>
    </div>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>


