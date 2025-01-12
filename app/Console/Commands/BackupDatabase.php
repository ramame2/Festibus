<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup MySQL Database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Get database connection details from .env file
        $host = env('DB_HOST', '127.0.0.1'); // Default to localhost if not found
        $port = env('DB_PORT', '3306'); // Default to 3306 if not found
        $username = env('DB_USERNAME'); // Get from .env (ensure you set this in .env)
        $password = env('DB_PASSWORD'); // Get from .env (ensure you set this in .env)
        $database = env('DB_DATABASE'); // Get from .env (ensure you set this in .env)

        // Check if the database credentials are set
        if (!$username || !$password || !$database) {
            $this->error('Database credentials are not properly set in .env');
            return;
        }

        // Define the backup file path
        $backupFile = storage_path('app/backups/' . $database . '_' . date('Y_m_d_H_i_s') . '.sql');

        // Command to run mysqldump
        $command = "mysqldump --host=$host --user=$username --password=$password --port=$port $database > $backupFile";

        // Execute the command
        $result = shell_exec($command);

        // Check the result of the backup command
        if ($result === null) {
            $this->info('Database backup created successfully at ' . $backupFile);
        } else {
            $this->error('Error creating the database backup!');
        }
    }
}
