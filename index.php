<?php
// Exibe todos os erros 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicia ou continua a sessão
session_start();
require_once 'Task.php';
require_once 'TaskManager.php';

// login com qualquer nome de usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
}

// Redireciona para a página de login se o usuário não estiver definido
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Inicia o gerenciador de tarefas se ele ainda não existir na sessão
if (!isset($_SESSION['taskManager'])) {
    $_SESSION['taskManager'] = serialize(new TaskManager());
}

// Deserializa o gerenciador de tarefas
$taskManager = unserialize($_SESSION['taskManager']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    
    <a href="add_task.php">Adicionar Nova Tarefa</a>
    
    <h2>Suas Tarefas</h2>
    <ul>
        <!-- Loop para exibir todas as tarefas -->
        <?php foreach ($taskManager->getTasks() as $index => $task) : ?>
            <li>
                <strong><?php echo htmlspecialchars($task->title); ?></strong><br>
                <?php echo htmlspecialchars($task->description); ?><br>
                Status: <?php echo htmlspecialchars($task->status); ?><br>
                <a href="edit_task.php?index=<?php echo $index; ?>">Editar</a>
                <a href="delete_task.php?index=<?php echo $index; ?>">Excluir</a>
                <a href="mark_complete.php?index=<?php echo $index; ?>">Marcar como Concluída</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

<?php
// Salva o gerenciador de tarefas para manter as tarefas mesmo depois que a página for recarregada
$_SESSION['taskManager'] = serialize($taskManager);
?>
