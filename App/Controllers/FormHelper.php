<?php

namespace App\Controllers;

abstract class FormHelper {
    protected const TEMPLATE = '';

    protected const REQUIRED_FIELDS = [];

    protected array $filteredInput = [];
    protected array $errors = [];

    public function __construct() {
        $this->filteredInput = array_map('htmlspecialchars', $_REQUEST);
    }

    public function get(): void {
        $USER_ARR = $_SESSION['user'];
        require_once $this::TEMPLATE;
    }

    public function post(): void {
        if ($this->ValidateForm()) {
            $this->submit();
        } else {
            $USER_ARR = $_SESSION['user'];
            require_once $this::TEMPLATE;
        }
    }

    protected function ValidateForm(): bool {
        if (!filter_var($this->filteredInput['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Укажите правильный <strong>Email</strong>.";
        }

        if (strlen($this->filteredInput['username'] ?? '') > 100) {
            $this->errors['username'] = 'Имя пользователя не может быть больше 100 символов.';
        }

        if (strlen($this->filteredInput['text'] ?? '') > 1000) {
            $this->errors['text'] = 'Текст не может больше 1000 символов.';
        }

        foreach ($this::REQUIRED_FIELDS as $name => $title) {
            if (($this->filteredInput[$name] ?? '') === '') {
                $this->errors[$name] = "Поле <strong>$title</strong> не заполнено.";
            }
        }

        return empty($this->errors);
    }

    abstract protected function submit(): void;
}
