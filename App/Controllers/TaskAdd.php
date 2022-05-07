<?php

namespace App\Controllers;
use App\Models\Task;

class TaskAdd extends FormHelper {
    protected const TEMPLATE = '../App/views/add.php';
    protected const REQUIRED_FIELDS = [
        'text' => 'Текст задачи',
        'username' => 'Имя пользователя',
        'email' => 'Email',
    ];

    protected function submit(): void {
        try {
            (new Task())->AddTask($this->getValidatedData());
        } catch (\Exception $e) {
            $_SESSION['error_message'] = 'Не удалось создать задачу '.$e;
            exit(header('Location: ./'));
        }
        
        $_SESSION['success_message'] = 'Новая задача успешно добавлена';
        header('Location: ./');
    }

    protected function getValidatedData(): array {
        return [
            'text' => $this->filteredInput['text'],
            'username' => $this->filteredInput['username'],
            'email' => $this->filteredInput['email'],
            'status' => null
        ];
    }
}
