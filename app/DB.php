<?php

namespace App;

use App\Exceptions\DBException;
use PDO;
use PDOException;

/**
 * Class DB
 * @package App
 */
final class DB extends Singleton
{
    private string $dbms = 'localhost';
    private string $host = 'BeeJee';
    private string $port = '3306';
    private string $db_name = 'mysql';
    private string $charset = 'utf8';

    private string $user;
    private string $password;

    private PDO $pdo;

    /**
     * DB constructor.
     * @throws DBException|PDOException
     */
    protected function __construct()
    {
        parent::__construct();

        $params = require '../config/database.php';

        $this->dbms = $params['dbms'] ?? $this->dbms;
        $this->host = $params['host'] ?? $this->host;
        $this->port = $params['port'] ?? $this->port;
        $this->db_name = $params['db_name'] ?? $this->db_name;
        $this->charset = $params['charset'] ?? $this->charset;

        if (empty($params['user'])) {
            throw new DBException('User is empty');
        }

        if (empty($params['password'])) {
            throw new DBException('Password is empty');
        }

        $this->pdo = $this->generatePDO();
    }

    /**
     * @param string $sql
     * @param mixed ...$args
     * @return array
     * @throws DBException|PDOException
     */
    public function query(string $sql, ...$args): array
    {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($args);

        if (false === $result) {
            throw new DBException($stmt->errorInfo()[2]);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @param mixed ...$args
     * @throws DBException|PDOException
     */
    public function execute(string $sql, ...$args): void
    {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($args);

        if (false === $result) {
            throw new DBException($stmt->errorInfo()[2]);
        }
    }

    /**
     * @return int
     */
    public function lastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @return PDO
     */
    private function generatePDO(): PDO
    {
        return new PDO($this->generateDSN(), $this->user, $this->password);
    }

    /**
     * @return string
     */
    private function generateDSN(): string
    {
        return sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s',
            $this->dbms,
            $this->host,
            $this->port,
            $this->db_name,
            $this->charset
        );
    }
}
