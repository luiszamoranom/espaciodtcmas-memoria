<?php

namespace App\Livewire\Private\Utilities\BackUps;

use Livewire\Component;
use Spatie\Backup\Config\Config;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class BackupsCreate extends Component
{

    public $response = '';

    public function createLocalBackup()
    {
        try {
            $configArray = config('backup');
            $config = Config::fromArray($configArray);
            $backupJob = BackupJobFactory::createFromConfig($config)
                ->onlyDbName(["pgsql"])
                ->setFilename("backup-memoria-" . date('Y-m-d-H-i-s') . ".zip");
            $backupJob->run();

            $this->response = "Copia de seguridad de la base de datos realizada con éxito";
            $this->dispatch("update-backups");
        } catch (\Exception $e) {
            $this->response = "Error al realizar la copia de seguridad: " . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.private.utilities.backups.backups-create');
    }
}
