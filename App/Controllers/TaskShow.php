<?php

namespace App\Controllers;
use App\Models\Task;

class TaskShow {
    protected const TEMPLATE = '../App/views/mainpage.php';
    
    protected const SORTING_FIELDS = [
        'username' => 'По имени пользователя',
        'email' => 'По Email',
        'status' => 'По статусу',
    ];
    protected const SORTING_ORDERS = [
        'ASC' => 'По возрастанию',
        'DESC' => 'По убыванию',
    ];
    protected const FIELDS_DEFAULTS = [
        'sort' => 'username',
        'sort_order' => 'DESC',
        'page' => 1,
    ];

    protected array $filteredInput = [];
    protected Task $model;

    public function __construct() {
        $this->model = new Task();
        $this->filteredInput = array_map('htmlspecialchars', $_REQUEST);

        foreach ($this::FIELDS_DEFAULTS as $field => $default) {
            $this->filteredInput[$field] = $this->filteredInput[$field] ?? $default;
        }
    }

    public function get(): void {
        $USER_ARR = $_SESSION['user'];
        $success_message = $_SESSION['success_message'];
        $error_message = $_SESSION['error_message'];
        unset($_SESSION['success_message']);
        unset($_SESSION['error_message']);
        $tasks = $this->showTasks();
        $AllTasksNumber = $this->model->all_tasks_number();
        $AllPagesNumber = ceil($AllTasksNumber / TASKS_PER_PAGE);

        require_once $this::TEMPLATE;
    }

    protected function showTasks(): array {
        $pageValid = ((int) $this->filteredInput['page']) > 0;
        $sortingValid = in_array(
            $this->filteredInput['sort'],
            array_keys($this::SORTING_FIELDS),
        );
        $sortingOrderValid = in_array(
            $this->filteredInput['sort_order'],
            array_keys($this::SORTING_ORDERS),
        );

        if ($pageValid) {
            $offset = ((int) $this->filteredInput['page'] - 1) * TASKS_PER_PAGE;
        } else {
            $offset = 0;
        }

        if ($sortingValid) {
            $sorting = $this->filteredInput['sort'];
        } else {
            $sorting = $this::FIELDS_DEFAULTS['sort'];
        }

        if ($sortingOrderValid) {
            $sortingOrder = $this->filteredInput['sort_order'];
        } else {
            $sortingOrder = $this::FIELDS_DEFAULTS['sort_order'];
        }

        return $this->model->getTasks($sorting, $sortingOrder, TASKS_PER_PAGE, $offset);
    }

    public function getPageUrl(int $page): string {
        return '?' . http_build_query(array_merge($_GET, ['page' => $page]));
    }
}
