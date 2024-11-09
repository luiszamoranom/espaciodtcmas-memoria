<?php

namespace App\Livewire\Private\Utilities\BackUps;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Backup\BackupDestination\BackupDestinationFactory;
use Spatie\Backup\Config\Config;

class BackupsList extends Component
{
    public $backups = [];

    #[On("update-backups")]
    public function obtenerListadoDeBackups()
    {
        $configArray = config('backup');
        $config = Config::fromArray($configArray);
        $backupDestinations = BackupDestinationFactory::createFromArray($config);

        $this->backups = [];
        foreach ($backupDestinations as $backupDestination) {
            foreach ($backupDestination->backups() as $backup) {
                if($backup->exists()){
                    $sizeInMB = $backup->sizeInBytes() / (1024 * 1024);
                    array_push($this->backups, [
                        'path' => $backup->path(),
                        'size_in_mb' => round($sizeInMB, 5),
                        'date' => $backup->date()->format('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }


    public function mount()
    {
        $this->obtenerListadoDeBackups();
    }

    public function render()
    {
        return view('livewire.private.utilities.backups.backups-list');
    }
}
