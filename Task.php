<?php
class Task {
    public $title;
    public $description;
    public $status;

    public function __construct($title, $description, $status = 'pendente') {
        // Inicializa as propriedades da tarefa
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
    }

    // editar a tarefa
    public function edit($title, $description, $status) {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
    }

    // marcar a tarefa como concluída
    public function markComplete() {
        $this->status = 'concluído';
    }
}
?>
