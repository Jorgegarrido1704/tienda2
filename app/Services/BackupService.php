<?php

// app/Services/BackupService.php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class BackupService
{
    public function run(string $motivo = 'manual'): bool
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');

        $backupDir = storage_path('app/backups');

        if (! file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $fileName = $motivo.'_'.$database.'_'.now()->format('Y-m-d_H-i-s').'.sql';
        $filePath = $backupDir.DIRECTORY_SEPARATOR.$fileName;

        $command = [
            'mysqldump',
            '-h', $host,
            '-P', $port,
            '-u', $username,
        ];

        if (! empty($password)) {
            $command[] = '-p'.$password;
        }

        $command[] = $database;

        $process = new Process($command);
        $process->setTimeout(300);

        try {
            $process->mustRun();
            file_put_contents($filePath, $process->getOutput());

            Log::info("Respaldo de BD generado correctamente: {$fileName}");

            $this->limpiarRespaldosViejos($backupDir);

            return true;
        } catch (\Throwable $e) {
            Log::error('Error generando respaldo de BD: '.$e->getMessage());

            return false;
        }
    }

    private function limpiarRespaldosViejos(string $backupDir, int $maxArchivos = 20): void
    {
        $archivos = glob($backupDir.DIRECTORY_SEPARATOR.'*.sql');

        if (count($archivos) <= $maxArchivos) {
            return;
        }

        usort($archivos, fn ($a, $b) => filemtime($a) <=> filemtime($b));

        $sobrantes = array_slice($archivos, 0, count($archivos) - $maxArchivos);

        foreach ($sobrantes as $archivo) {
            @unlink($archivo);
        }
    }
}
