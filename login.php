<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar se utilizador está  na base de dados
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar senha (substituir por password_verify() para hash seguro)
        if ($password == $user['password']) { // Alterar para password_verify($password, $user['password']) se usar hashes
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['user_role'] = $user['role'];
            header("Location: index.php"); // Redirecionar após login abre a página index.php o a
            exit();
        } else {
            $error = "Senha incorreta.";
        }
    } else {
        $error = "Utilizador não encontrado.";
    }
}
?>
<?php include 'header.php'; ?> <!-- Incluir o header -->
<div class="container mt-5">
    <h1 class="text-center">Login</h1>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <!-- Vídeo abaixo do formulário -->
    <div class="mt-4">
        <video controls class="w-100 rounded shadow">
            <source src="video/video.mp4" type="video/mp4">
            Seu navegador não suporta a tag de vídeo.
        </video>
    </div>
</div>
<?php include 'footer.php'; ?> <!-- Incluir o footer -->
