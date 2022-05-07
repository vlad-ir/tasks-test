<?php

namespace App\Models;

abstract class Model {
    protected static $DB_link;

    public function __construct() {
        if (!self::$DB_link) {
            self::$DB_link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            mysqli_query(self::$DB_link, "SET NAMES 'utf8'");

            if (mysqli_connect_errno()) {
                exit(printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error()));
            }
        }
    }
}
