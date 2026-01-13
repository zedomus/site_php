<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM equipamentos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $equipamento = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];

        $stmt = $conn->prepare("UPDATE equipamentos SET nome = ?, descricao = ?, quantidade = ? WHERE id = ?");
        $stmt->bind_param("ssii", $nome, $descricao, $quantidade, $id);
        $stmt->execute();
        header("Location: lista_equipamentos.php");
        exit();
    }
} else {
    header("Location: lista_equipamentos.php");
    exit();
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center">Editar Equipamento</h1>
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Equipamento</label>
            <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($equipamento['nome']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" value="<?php echo htmlspecialchars($equipamento['descricao']); ?>">
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" name="quantidade" class="form-control" value="<?php echo $equipamento['quantidade']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Guardar Alterações</button>
    </form>
</div>

<?php include 'footer.php'; ?>
