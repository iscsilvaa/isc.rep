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
$index = $_GET['index'];

// Exclui a tarefa no índice especificado
$taskManager->deleteTask($index);

// Serializa o gerenciador de tarefas e redireciona para a página principal
$_SESSION['taskManager'] = serialize($taskManager);
header('Location: index.php');
exit;
?>
