<?php
// exibe todos os erros para fins de depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// inicia ou continua a sessão
session_start();
require_once 'Task.php';
require_once 'TaskManager.php';

// deserializa o gerenciador de tarefas da sessão
$taskManager = unserialize($_SESSION['taskManager']);
$index = $_GET['index'];

// verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Edita a tarefa no índice especificado
    $taskManager->editTask($index, $_POST['title'], $_POST['description'], $_POST['status']);
    
    // salve o gerenciador de tarefas e depois volte para a página principal
    $_SESSION['taskManager'] = serialize($taskManager);
    header('Location: index.php');
    exit;
}

// Obtém a tarefa a ser editada
$task = $taskManager->getTasks()[$index];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarefa</title>
</head>
<body>
    <h1>Editar Tarefa</h1>
    <!-- Formulário para editar uma tarefa existente -->
    <form action="edit_task.php?index=<?php echo $index; ?>" method="POST">
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task->title); ?>" required><br>

        <label for="description">Descrição:</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($task->description); ?></textarea><br>

        <label for="status">Status:</label>
        <select name="status">
            <option value="pendente" <?php if ($task->status == 'pendente') echo 'selected'; ?>>Pendente</option>
            <option value="concluído" <?php if ($task->status == 'concluído') echo 'selected'; ?>>Concluído</option>
        </select><br>

        <input type="submit" value="Atualizar">
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>
