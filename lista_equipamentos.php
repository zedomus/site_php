<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php'; // Ligação à base de dados
include 'header.php'; // Vai buscar o Cabeçalho

// Adicionar Equipamento
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $data_registo = date('Y-m-d'); // Obtém a data atual no formato YYYY-MM-DD

    $stmt = $conn->prepare("INSERT INTO equipamentos (nome, tipo, descricao, quantidade, data_registo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $nome, $tipo, $descricao, $quantidade, $data_registo);
    $stmt->execute();
    header("Location: lista_equipamentos.php");
    exit();
}

// Apagar Equipamentos
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM equipamentos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: lista_equipamentos.php");
    exit();
}

// Procurar Equipamentos
$result = $conn->query("SELECT * FROM equipamentos ORDER BY data_registo DESC");
?>

<div class="container mt-5">
    <h1 class="text-center">Gestão de Equipamentos</h1>
    <!-- Botão para Voltar à Página Inicial -->
    <div class="d-flex justify-content-start mb-4">
        <a href="index.php" class="btn btn-secondary">Voltar à Página Inicial</a>
    </div>
    <!-- Formulário para Adicionar Equipamento -->
    <form method="POST" class="mt-4">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" name="nome" class="form-control" placeholder="Nome do Equipamento" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="tipo" class="form-control" placeholder="Tipo do Equipamento" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="quantidade" class="form-control" placeholder="Quantidade" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="descricao" class="form-control" placeholder="Descrição (opcional)">
            </div>
        </div>
        <button type="submit" name="adicionar" class="btn btn-primary w-100">Adicionar Equipamento</button>
    </form>

    <!-- Listagem dos Equipamentos -->
    <div class="mt-5">
        <h2 class="text-center">Lista de Equipamentos</h2>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Data de Registo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                        <td><?php echo $row['quantidade']; ?></td>
                        <td><?php echo $row['data_registo']; ?></td>
                        <td>
                            <a href="editar_equipamento.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="lista_equipamentos.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja apagar este equipamento?')">Apagar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
