<?php
// Exibe todos os erros para fins de depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicia ou continua a sessão
session_start();
require_once 'Task.php';
require_once 'TaskManager.php';

// Deserializa o gerenciador de tarefas da sessão
$taskManager = unserialize($_SESSION['taskManager']);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cria uma nova tarefa e a adiciona ao gerenciador
    $newTask = new Task($_POST['title'], $_POST['description']);
    $taskManager->addTask($newTask);
    
    // Serializa o gerenciador de tarefas e redireciona para a página principal
    $_SESSION['taskManager'] = serialize($taskManager);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Tarefa</title>
</head>
<body>
    <h1>Adicionar Nova Tarefa</h1>
    <!-- Formulário para adicionar uma nova tarefa -->
    <form action="add_task.php" method="POST">
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="description">Descrição:</label>
        <textarea name="description" id="description" required></textarea><br>

        <input type="submit" value="Adicionar">
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>
