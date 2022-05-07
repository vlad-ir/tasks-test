<?php

namespace App\Models;

class User extends Model {
    protected string $query_table = 'users';

    public function FindUser(string $username, string $password) {
        $db_query = self::$DB_link->prepare(
            "SELECT username, password, is_admin
            FROM $this->query_table
            WHERE username = ?"
        );
        $db_query->bind_param('s', $username);
        $db_query->execute();
        $user = $db_query->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        
        if(password_verify($password, $user['password'])){
            return $user;
        }
        return false;
    }
}
