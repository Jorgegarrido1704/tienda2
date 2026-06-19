<?php

// app/Services/BackupService.php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BackupService
{
    public function run(string $motivo = 'manual'): bool
    {
        $database = config('database.connections.mysql.database');
        $backupDir = storage_path('app/backups');

        if (! file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $fileName = $motivo.'_'.$database.'_'.now()->format('Y-m-d_H-i-s').'.sql';
        $filePath = $backupDir.DIRECTORY_SEPARATOR.$fileName;

        try {
            $sql = $this->generarDump($database);
            file_put_contents($filePath, $sql);

            Log::info("Respaldo de BD generado correctamente: {$fileName}");

            $this->limpiarRespaldosViejos($backupDir);

            return true;
        } catch (\Throwable $e) {
            Log::error('Error generando respaldo de BD: '.$e->getMessage());

            return false;
        }
    }

    private function generarDump(string $database): string
    {
        $output = '-- Respaldo generado: '.now()->toDateTimeString()."\n";
        $output .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        $tablas = DB::select('SHOW TABLES');
        $key = 'Tables_in_'.$database;

        foreach ($tablas as $tablaObj) {
            $tabla = $tablaObj->$key;

            // --- Estructura de la tabla ---
            $output .= "-- Estructura de tabla `{$tabla}`\n";
            $output .= "DROP TABLE IF EXISTS `{$tabla}`;\n";

            $create = DB::select("SHOW CREATE TABLE `{$tabla}`");
            $createSql = $create[0]->{'Create Table'};
            $output .= $createSql.";\n\n";

            // --- Datos de la tabla ---
            $filas = DB::table($tabla)->get();

            if ($filas->count() > 0) {
                $output .= "-- Datos de tabla `{$tabla}`\n";

                foreach ($filas as $fila) {
                    $filaArray = (array) $fila;
                    $columnas = array_keys($filaArray);
                    $valores = array_map(function ($valor) {
                        if ($valor === null) {
                            return 'NULL';
                        }

                        return "'".str_replace(
                            ['\\', "'", "\n", "\r"],
                            ['\\\\', "\\'", '\\n', '\\r'],
                            $valor
                        )."'";
                    }, array_values($filaArray));

                    $columnasStr = '`'.implode('`, `', $columnas).'`';
                    $valoresStr = implode(', ', $valores);

                    $output .= "INSERT INTO `{$tabla}` ({$columnasStr}) VALUES ({$valoresStr});\n";
                }

                $output .= "\n";
            }
        }

        $output .= "SET FOREIGN_KEY_CHECKS=1;\n";

        return $output;
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
