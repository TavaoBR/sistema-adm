<?php 

namespace Src\Database; 

use PDO;

class Connection {

    private static $connection = null;
    
    public static function connect(): PDO{
        
        $host = $_ENV['HOST_DB'];
        $db = $_ENV['DB'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $port = 3306;

        if (!self::$connection) {
            self::$connection = new PDO($db . ":host=" . $host . ";port=" . $port . ";dbname=" . $dbname, $user, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        }

        return self::$connection;
    }

}