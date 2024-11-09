<?php

namespace App\Livewire\Private\Utilidades;

use Livewire\Attributes\Title;
use Livewire\Component;

class CopiasDeSeguridad extends Component
{
    #[Title('Copia de Seguridad')]
    public function render()
    {
        return view('livewire.private.utilidades.copias-de-seguridad');
    }
}
