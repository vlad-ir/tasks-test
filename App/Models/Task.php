<?php

namespace App\Models;

class Task extends Model {
    protected string $query_table = 'tasks';

    public function getTasks(
        string $orderField = 'id',
        string $orderDirection = 'ASC',
        ?int $limit = null,
        int $offset = 0
    ): array {
        $limit = $limit ?? 'NULL';
        $db_query = self::$DB_link->prepare(
            "SELECT id, username, email, text, status, text_edited
            FROM $this->query_table
            ORDER BY $orderField $orderDirection
            LIMIT ? OFFSET ?"
        );
        $db_query->bind_param('ii', $limit, $offset);
        $db_query->execute();
        return $db_query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function AddTask(array $data): bool {
        $db_query = self::$DB_link->prepare("INSERT INTO $this->query_table (username, email, text, status) VALUES (?, ?, ?, ?)");
        $db_query->bind_param('sssi', $data['username'], $data['email'], $data['text'], $data['status']);
        return $db_query->execute();
    }

    public function EditTask(array $data): bool {
        $db_query = self::$DB_link->prepare(
            "UPDATE $this->query_table
            SET username = ?, email = ?, text = ?, status = ?, text_edited = ?
            WHERE id = ?"
        );
        $db_query->bind_param('sssiii', $data['username'], $data['email'], $data['text'], $data['status'], $data['text_edited'], $data['id']);
        return $db_query->execute();
    }

    public function findTaskById(int $id) {
        $db_query = self::$DB_link->prepare(
            "SELECT id, username, email, text, status, text_edited
            FROM $this->query_table
            WHERE id = ?"
        );
        $db_query->bind_param('i', $id);
        $db_query->execute();
        return $db_query->get_result()->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function all_tasks_number(): int {
        return self::$DB_link->query("SELECT COUNT(id) FROM $this->query_table")->fetch_array(MYSQLI_NUM)[0];
    }
}