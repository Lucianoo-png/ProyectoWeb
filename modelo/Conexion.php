<?php

class Conexion
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $driver;
    private $port;
    private $pdo;

    public function __construct()
    {
        $config = [
            "driver" => "pgsql",
            "host" => "127.0.0.1",
            //"host" => "db",
            "db" => "ecommerce",
            "user" => "postgres",
            "password" => "12345", //Recuerda que yo tengo que cambiar la constraseña hasta el 8
            "port" => "5432",
        ];
        $this->driver = $config["driver"] ?? "mysql";
        $this->host = $config["host"] ?? "127.0.0.1";
        $this->db = $config["db"] ?? "testdb";
        $this->user = $config["user"] ?? "root";
        $this->password = $config["password"] ?? "";
//bueeeeeeeno
        if (!isset($config["port"])) {
            $this->port = $this->driver === "pgsql" ? "5432" : "3306";
        } else {
            $this->port = $config["port"];
        }
    }

    public function comenzarTransaccion() {
        if ($this->pdo === null) $this->conectar();
        return $this->pdo->beginTransaction();
    }

    public function confirmarTransaccion() {
        return $this->pdo->commit();
    }

    public function cancelarTransaccion() {
        return $this->pdo->rollBack();
    }

    public function conectar()
    {
        try {
            $dsn = $this->buildDsn();

            $this->pdo = new PDO($dsn, $this->user, $this->password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC,
            );
        } catch (PDOException $e) {
            die(
                "Error al conectar a la base de datos ({$this->driver}): " .
                    $e->getMessage()
            );
        }
    }

    private function buildDsn()
    {
        switch ($this->driver) {
            case "mysql":
                return "mysql:host={$this->host};port={$this->port};dbname={$this->db};charset=utf8";
            case "pgsql":
                return "pgsql:host={$this->host};port={$this->port};dbname={$this->db}";
            default:
                throw new Exception(
                    "Driver de base de datos no soportado: {$this->driver}",
                );
        }
    }

    public function ejecutarConsulta(string $sql, array $params = [])
    {
        try {
            if ($this->pdo === null) {
                $this->conectar();
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return null;
        } catch (Exception $e) {
            return null;
        }
    }
}

?>