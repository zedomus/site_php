<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão apenas se nenhuma estiver ativa
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Equipamentos - LED</title>
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-light py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logotipo do projeto e Nome para plataforma -->
            <div class="d-flex align-items-center">
                <img src="images/logo.png" alt="Logo do Projeto" style="height: 50px;">
                <h1 class="h5 ms-3 m-0">Gestão Equipamentos LED</h1>
            </div>

            <!-- Informações do Utilizador e Botões -->
            <div class="text-end">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <span class="me-3">Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
                    <span class="me-3"><?php echo date('d/m/Y H:i'); // Mostra data e hora atual ?></span>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-success">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
