<?php
class TaskManager {
    private $tasks = array();

     // A tarefa é passada como um objeto e é adicionada ao final do array
    public function addTask($task) {
        $this->tasks[] = $task;
    }

    // Verifica se o índice da tarefa existe antes de tentar editar
    public function editTask($index, $title, $description, $status) {
        if(isset($this->tasks[$index])) {
            $this->tasks[$index]->edit($title, $description, $status);
        }
    }

    // Após excluir, reindexa o array para manter os índices
    public function deleteTask($index) {
        if(isset($this->tasks[$index])) {
            unset($this->tasks[$index]);
            $this->tasks = array_values($this->tasks); // reindexar array
        }
    }

    // Verifica se o índice da tarefa existe antes de tentar marcar como concluída
    public function markComplete($index) {
        if(isset($this->tasks[$index])) {
            $this->tasks[$index]->markComplete();
        }
    }



    // Retorna o array de tarefas armazenado na propriedade $tasks
    public function getTasks() {
        return $this->tasks;
    }
}
?>
