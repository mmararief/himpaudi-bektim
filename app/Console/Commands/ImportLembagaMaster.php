<?php

namespace App\Console\Commands;

use App\Imports\LembagaMastersImport;
use Illuminate\Console\Command;

class ImportLembagaMaster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lembaga:import {file : Path to CSV file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data lembaga master dari file CSV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        // Validate file exists
        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return 1;
        }

        // Validate file extension
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if ($extension !== 'csv') {
            $this->error('File harus berformat CSV (.csv)');
            return 1;
        }

        $this->info('Memulai import data lembaga master...');
        $this->newLine();

        try {
            $import = new LembagaMastersImport();

            $import->import($filePath);

            $this->newLine();
            $this->info('✓ Import selesai!');
            $this->newLine();

            $this->table(
                ['Status', 'Jumlah'],
                [
                    ['Data baru diimpor', $import->getImported()],
                    ['Data diperbarui', $import->getUpdated()],
                    ['Data dilewati', $import->getSkipped()],
                    ['Error', count($import->getErrors())],
                ]
            );

            // Show errors if any
            if (count($import->getErrors()) > 0) {
                $this->newLine();
                $this->warn('Error yang terjadi:');
                foreach ($import->getErrors() as $error) {
                    $this->error($error);
                }
            }

            return 0;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat import:');
            $this->error($e->getMessage());
            return 1;
        }
    }
}
