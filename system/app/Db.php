<?php

class Db
{
    static $pdo = null;

    private static function pdo()
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $config = Config::DB;

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s;',
            $config['host'],
            $config['name'],
            $config['charset']
        );
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $config['user'], $config['password'], $opt);

        return $pdo;
    }

    static function all(string $query, array $params = [])
    {
        $stmt = self::pdo()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchAll();

        return $data;
    }

    static function row(string $query, array $params = [])
    {
        $stmt = self::pdo()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetch();

        return $data;
    }

    static function field(string $query, array $params = [])
    {
        $stmt = self::pdo()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchColumn();

        return $data;
    }

    static function exec(string $query, array $params = [])
    {
        $stmt = self::pdo()->prepare($query);
        $stmt->execute($params);
    }

    static function escapeLike($s)
    {
        $s = self::pdo()->quote($s);
        $s = str_replace('%', '\%', $s);
        $s = str_replace('_', '\_', $s);
        $s = trim($s, "'");
        $s = "'%$s%'";

        return $s;
    }
}
