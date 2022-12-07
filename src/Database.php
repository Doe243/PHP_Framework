<?php

namespace App;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';

        $user = $config['user'] ?? '';

        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);

        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();

        $appliedMigrations = $this->getAppliedMigrations();

        //Utils::preEcho($appliedMigrations);

        $newMigrations = [];

        $files = scandir(Application::$ROOT_DIR.'/src/migrations');

        $toAppliedMigrations = array_diff($files, $appliedMigrations);

        //Utils::preEcho($toAppliedMigrations);

        foreach ($toAppliedMigrations as $migration) {

            
            if ($migration === "." || $migration === "..") {
                
                continue;
            }
            
            //Utils::preEcho($migration);
            
            require_once Application::$ROOT_DIR.'/src/migrations/'.$migration;

            $className = pathinfo($migration, PATHINFO_FILENAME);

            //Utils::preEcho($className);

            $instance = new $className();

            $this->log("Applying migration $migration");

            $instance->up();

            $this->log("Applied migration $migration");

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            
            $this->saveMigrations($newMigrations);

        } else{

             $this->log("All Migrations are applied");
        }


    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (

         id INT AUTO_INCREMENT PRIMARY KEY,

         migration VARCHAR(255),

         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {

        $str = implode(",",array_map(fn($m) => "('$m')", $migrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str ");

        $statement->execute();
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    protected function log($message)
    {
        echo '['. date('Y-m-d H:i:s') . '] - ' . $message .PHP_EOL;
    }
}
