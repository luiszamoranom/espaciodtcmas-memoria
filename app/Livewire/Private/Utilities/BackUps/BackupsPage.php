<?php

namespace App\Livewire\Private\Utilities\BackUps;

use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Backup\BackupDestination\BackupDestinationFactory;
use Spatie\Backup\Config\Config;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class BackupsPage extends Component
{
    #[Title('Copia de Seguridad')]
    public function render()
    {
        return view('livewire.private.utilities.backups.backups-page');
    }
}
