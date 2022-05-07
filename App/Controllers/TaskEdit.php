<?php

namespace App\Controllers;
use App\Models\Task;

class TaskEdit extends FormHelper {
    protected const TEMPLATE = '../App/views/edit.php';

    protected const REQUIRED_FIELDS = [
        'id' => 'Номер',
        'text' => 'Текст задачи',
        'username' => 'Имя пользователя',
        'email' => 'Email'
    ];

    protected Task $model;
    protected array $task;

    public function __construct() {
        if (!$this->checkPermission()) {
            exit(header('Location: ./login'));
        }

        parent::__construct();
        $this->model = new Task();
        $this->task = $this->findEditedTask();
    }

    protected function checkPermission(): bool {
        return $_SESSION['user']['is_admin'] ?? false;
    }

    protected function findEditedTask(): array {
        $task = $this->model->findTaskById($this->filteredInput['id']);
        if (!$task) {
            http_response_code(404);
            exit(header('Location: ./error'));
        }
        return $task;
    }

    protected function submit(): void {
        try {
            $this->model->EditTask($this->getValidatedData());
        } catch (\Exception $e) {
            $_SESSION['error_message'] = 'Не удалось отредактировать задачу '.$e;
            exit(header('Location: ./'));
        }
        $_SESSION['success_message'] = 'Задача успешно отредактирована';
        header('Location: ./');
    }

    protected function getValidatedData(): array {
        return [
            'id' => $this->filteredInput['id'],
            'text' => $this->filteredInput['text'],
            'username' => $this->filteredInput['username'],
            'email' => $this->filteredInput['email'],
            'status' => $this->filteredInput['status'],
            'text_edited' => $this->isTextModified() ? 1 : null,
        ];
    }

    protected function isTextModified(): bool {        
        return (!empty($this->task['text_edited']) || $this->filteredInput['text'] !== $this->task['text']);
    }
}
