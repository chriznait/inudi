<?php

namespace App\Exports;

use App\Models\Registered;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class RegisteredExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function headings(): array
    {
        return [
            'username',
            'firstname',
            'lastname',
            'email',
            'phone',
            'course',
            'country',
            'montoPagado',
            'fechaPago',
        ];
    }

    public function query()
    {
        //$registrados = DB::table('registereds')->pluck('idPersona');
        //return $registrados;
        return Registered::query()
        ->join('people', 'people.id', '=', 'registereds.idPersona')
        ->where('registereds.idCurso', '=', $this->id)
        ->where('registereds.estado', '=', '2')
        ->select('people.nroDocumento', 'people.nombre', 'people.apellido',
            'people.email', 'people.telefono','registereds.idCurso','people.idPais', 'registereds.montoPagado', 'registereds.fechaPago');
    }
}
