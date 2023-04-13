<?php
interface DatabaseInterface {
    public function query(string $sql, array $params = []): array;
}

interface LoggerInterface {
    public function log(string $message);
}

class MySQLDatabase implements DatabaseInterface {
    private $host;
    private $port;
    private $dbname;
    private $user;
    private $password;

    public function __construct(string $host, string $port, string $dbname, string $user, string $password) {
        $this->host = $host;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function query(string $sql, array $params = []): array {
        // Connect to MySQL database and execute query
        return [];
    }
}

class FileLogger implements LoggerInterface {
    private $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    public function log(string $message) {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] $message" . PHP_EOL;
        file_put_contents($this->filePath, $logMessage, FILE_APPEND);
    }
}

class ProductService {
    private $database;
    private $logger;

    public function __construct(DatabaseInterface $database, LoggerInterface $logger) {
        $this->database = $database;
        $this->logger = $logger;
    }

    public function createProduct(string $name, float $price) {
        // Do some validation and business logic
        $this->database->query('INSERT INTO products (name, price) VALUES (:name, :price)', [':name' => $name, ':price' => $price]);
        $this->logger->log("Product created: $name ($price)");
    }
}

// Usage example
$database = new MySQLDatabase('localhost', '3306', 'mydatabase', 'myuser', 'mypassword');
$logger = new FileLogger('/var/log/myapp.log');
$productService = new ProductService($database, $logger);

$productService->createProduct('Example Product', 9.99);
