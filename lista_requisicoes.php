<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php'; // Ligação à base de dados
include 'header.php'; // Vai abrir a página para o Cabeçalho

// Adicionar Requisição
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adicionar'])) {
    $equipamento_id = $_POST['equipamento_id'];
    $requisitante_id = $_SESSION['user_id']; // User atual como requisitante
    $data_requisicao = date('Y-m-d'); // Data atual como data de requisição

    $stmt = $conn->prepare("INSERT INTO requisicoes (equipamento_id, requisitante_id, data_requisicao) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $equipamento_id, $requisitante_id, $data_requisicao);
    $stmt->execute();
    header("Location: lista_requisicoes.php");
    exit();
}

// Atualizar Estado (Devolução)
if (isset($_GET['devolver'])) {
    $id = $_GET['devolver'];
    $data_devolucao = date('Y-m-d'); // Data atual como data de devolução

    $stmt = $conn->prepare("UPDATE requisicoes SET estado = 'devolvido', data_devolucao = ? WHERE id = ?");
    $stmt->bind_param("si", $data_devolucao, $id);
    $stmt->execute();
    header("Location: lista_requisicoes.php");
    exit();
}

// Apagar Requisição
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM requisicoes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: lista_requisicoes.php");
    exit();
}

// Procurar Requisições
$result = $conn->query("SELECT r.id, e.nome AS equipamento, u.nome AS requisitante, r.data_requisicao, r.data_devolucao, r.estado
                        FROM requisicoes r
                        INNER JOIN equipamentos e ON r.equipamento_id = e.id
                        INNER JOIN users u ON r.requisitante_id = u.id
                        ORDER BY r.data_requisicao DESC");
?>

<div class="container mt-5">
    <h1 class="text-center">Gestão de Requisições</h1>
    <!-- Botão para Voltar à Página Inicial -->
    <div class="d-flex justify-content-start mb-4">
        <a href="index.php" class="btn btn-secondary">Voltar à Página Inicial</a>
    </div>
    <!-- Formulário para Adicionar Requisição -->
    <form method="POST" class="mt-4">
        <div class="row mb-3">
            <div class="col-md-8">
                <select name="equipamento_id" class="form-select" required>
                    <option value="">Selecione um Equipamento</option>
                    <?php
                    // Procurar Equipamentos para Requisição
                    $equipamentos = $conn->query("SELECT id, nome FROM equipamentos");
                    while ($equipamento = $equipamentos->fetch_assoc()):
                    ?>
                        <option value="<?php echo $equipamento['id']; ?>"><?php echo $equipamento['nome']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" name="adicionar" class="btn btn-primary w-100">Adicionar Requisição</button>
            </div>
        </div>
    </form>

    <!-- Listagem das Requisições -->
    <div class="mt-5">
        <h2 class="text-center">Lista de Requisições</h2>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Equipamento</th>
                    <th>Requisitante</th>
                    <th>Data de Requisição</th>
                    <th>Data de Devolução</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['equipamento']); ?></td>
                        <td><?php echo htmlspecialchars($row['requisitante']); ?></td>
                        <td><?php echo $row['data_requisicao']; ?></td>
                        <td><?php echo $row['data_devolucao'] ? $row['data_devolucao'] : 'Não devolvido'; ?></td>
                        <td><?php echo ucfirst($row['estado']); ?></td>
                        <td>
                            <?php if ($row['estado'] == 'pendente'): ?>
                                <a href="lista_requisicoes.php?devolver=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Devolver</a>
                            <?php endif; ?>
                            <a href="lista_requisicoes.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja apagar esta requisição?')">Apagar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
