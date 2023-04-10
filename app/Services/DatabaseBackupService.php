<?php

namespace App\Services;

class DatabaseBackupService
{
    public function createBackup()
    {
        $databaseName = config('database.connections.mysql.database');
        $databaseUsername = config('database.connections.mysql.username');
        $databasePassword = config('database.connections.mysql.password');
        $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $backupFilePath = resource_path('backup/' . $backupFileName);

        $command = "mysqldump --opt -h " . env('DB_HOST') . " -u $databaseUsername -p $databasePassword $databaseName > $backupFilePath";


        exec($command);

        return $backupFilePath;
    }
}
