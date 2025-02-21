<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelComp extends Component
{

    use WithFileUploads;

    public $archivo;
    public $contenido = [];
    public $respuesta = '';

    public $errores = [];

    public function subirArchivo()
    {
        if ($this->archivo && pathinfo($this->archivo->getClientOriginalName(), PATHINFO_EXTENSION) == 'xlsx') {
            $path = $this->archivo->getRealPath();
            $rows = SimpleExcelReader::create($path)->getRows()->toArray();
            $this->errores = $this->validarFilas($rows);
            if (empty($this->errores)) {
                $this->contenido = $rows;
                $this->respuesta = "Archivo subido y leído correctamente.";
            } else {
                $this->respuesta = "El archivo contiene errores.";
            }
        } else {
            $this->respuesta = "No se ha seleccionado ningún archivo o el formato no es válido.";
        }
    }

    private function validarFilas($rows)
    {
        $errores = [];
        $rowIndex = 1;
        foreach ($rows as $row) {
            $colIndex = 1;
            foreach ($row as $cell) {
                if (!preg_match('/^\d+$/', $cell)) {
                    $errores[] = "Fila " . $rowIndex . ", Columna " . $colIndex . ": el valor no es un dígito.";
                }
                $colIndex++;
            }
            $rowIndex++;
        }
        return $errores;
    }


    public function render()
    {
        return view('livewire.excel');
    }
}
