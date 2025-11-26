<?php
// config/configDB.php

class configDB {
    private $pdo;

    public function getInstance() {
        if ($this->pdo === null) {
            // 1. LEER VARIABLES DE ENTORNO (Render)
            $host = getenv('DB_HOST');
            $db   = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');
            $port = getenv('DB_PORT') ?: 3306;

            // 2. CONFIGURACIÓN LOCAL (Si no hay variables de entorno, usa esto)
            if (!$host) {
                $host = 'db'; // Nombre del servicio en tu docker-compose local
                $db   = 'products_db';
                $user = 'usuario_app';
                $pass = 'clave_app';
            }

            try {
                $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
                
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    // ESTO ES CLAVE PARA MARIADB CLOUD (SSL)
                    PDO::MYSQL_ATTR_SSL_CA => '/etc/ssl/certs/ca-certificates.crt',
                ];

                $this->pdo = new PDO($dsn, $user, $pass, $options);

            } catch (PDOException $e) {
                // En producción no mostrar errores detallados
                error_log($e->getMessage()); // Guardar en log interno
                die("Error de conexión a la Base de Datos. Revisa los logs.");
            }
        }
        return $this->pdo;
    }
}
?>