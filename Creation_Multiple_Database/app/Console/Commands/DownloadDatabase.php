<?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use Illuminate\Support\Facades\Process;
// use Illuminate\Support\Facades\File;

// class DownloadDatabase extends Command
// {
//     protected $signature = 'db:download-database';
//     protected $description = 'Downloads the Database';

//     public function handle(): int
//     {
//         $this->info('Downloading Database...');

//         // 1. Fetch config values safely from Laravel database configuration
//         $db_host = config('database.connections.mysql.host', '127.0.0.1');
//         $dbPort = config('database.connections.mysql.port', '3307');
//         $db_name = config('database.connections.mysql.database', 'm_creation_db');
//         $db_user = config('database.connections.mysql.username', 'root');
//         $db_pass = config('database.connections.mysql.password', '');

//         // 2. Path to XAMPP mysqldump.exe
//         $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe';

//         // 3. Ensure exports folder exists
//         $export_path = storage_path('app/public/exports');
//         if (!File::exists($export_path)) {
//             File::makeDirectory($export_path, 0755, true);
//         }

//         $fileName = 'DatabaseExtraction_' . date('Y_m_d_His') . '.sql';
//         $fullPath = $export_path . '/' . $fileName;

//         $passArgs = !empty($db_pass) ? "--password={$db_pass}" : "";

//         // 4. Construct command
//         $command = sprintf(
//             'cmd /c ""%s" --host=%s --port=%s --user=%s %s %s > "%s""',
//             $mysqldumpPath,
//             $db_host,
//             $dbPort,
//             $db_user,
//             $passArgs,
//             $db_name,
//             $fullPath
//         );

//         // 5. Run process
//         $result = Process::run($command);

//         // 6. CHECK FILE SIZE: If empty or process failed, DELETE the 0-byte file
//         if ($result->failed() || !File::exists($fullPath) || File::size($fullPath) === 0) {
//             if (File::exists($fullPath)) {
//                 File::delete($fullPath); // Delete empty 0-byte file
//             }
//             $this->error("mysqldump failed! Error: " . $result->errorOutput());
//             return Command::FAILURE;
//         }

//         $this->info('Able to fetch Database');
//         return Command::SUCCESS;
//     }
// }


namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DownloadDatabase extends Command
{
    protected $signature = 'db:download-database';
    protected $description = 'Downloads the Database to private storage';

    public function handle(): int
    {
        $this->info('Downloading Database...');

        // 1. Fetch config values safely from Laravel database configuration
        $db_host = config('database.connections.mysql.host', '127.0.0.1');
        $dbPort  = config('database.connections.mysql.port', '3306');
        $db_name = config('database.connections.mysql.database', 'm_creation_db');
        $db_user = config('database.connections.mysql.username', 'root');
        $db_pass = config('database.connections.mysql.password', '');

        // 2. Path to XAMPP mysqldump.exe
        $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe';

        // 3. Ensure exports folder exists in private 'local' disk (storage/app/exports)
        $disk = 'local';
        $folder = 'exports';

        if (!Storage::disk($disk)->exists($folder)) {
            Storage::disk($disk)->makeDirectory($folder);
        }

        $fileName = 'DatabaseExtraction_' . date('Y_m_d_His') . '.sql';
        $relativePath = $folder . '/' . $fileName;

        // Get absolute local path required by mysqldump
        $fullPath = Storage::disk($disk)->path($relativePath);

        $passArgs = !empty($db_pass) ? "--password={$db_pass}" : "";

        // 4. Construct command
        $command = sprintf(
            'cmd /c ""%s" --host=%s --port=%s --user=%s %s %s > "%s""',
            $mysqldumpPath,
            $db_host,
            $dbPort,
            $db_user,
            $passArgs,
            $db_name,
            $fullPath
        );

        // 5. Run process
        $result = Process::run($command);

        // 6. Check file size: If empty or process failed, delete file
        if ($result->failed() || !File::exists($fullPath) || File::size($fullPath) === 0) {
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
            $this->error("mysqldump failed! Error: " . $result->errorOutput());
            return Command::FAILURE;
        }

        $this->info("Database exported successfully to private storage: {$relativePath}");
        return Command::SUCCESS;
    }
}