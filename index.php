<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redireciona para a pagina login se não estiver logado
    exit();
}
include 'header.php'; // Inclui o header
?>

<div class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container mt-5">
            <!-- Mostra a mensagem de Boas-Vindas -->
            <h1 class="text-center">Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
            <p class="text-center mt-3">Escolha uma das opções abaixo para continuar:</p>

            <!-- Menu com Imagens e Botões -->
            <div class="row justify-content-center mt-4">
                <!-- Coluna 1: Gestão de Equipamentos -->
                <div class="col-12 col-md-6 text-center mb-4">
                    <a href="lista_equipamentos.php" class="btn btn-primary w-100 mt-2">Gestão de Equipamentos</a>
                    <div class="ratio ratio-16x9 mt-3">
                        <img src="images/equipamentos.jpg" alt="Equipamentos" class="img-thumbnail">
                    </div>
                </div>
                
                <!-- Coluna 2: Gestão de Requisições -->
                <div class="col-12 col-md-6 text-center mb-4">
                    <a href="lista_requisicoes.php" class="btn btn-secondary w-100 mt-2">Gestão de Requisições</a>
                    <div class="ratio ratio-16x9 mt-3">
                        <img src="images/requisicoes.jpg" alt="Requisições" class="img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?> <!-- Vai buscar o rodapé -->
</div>
