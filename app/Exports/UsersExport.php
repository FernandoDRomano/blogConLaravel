<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings, WithStyles, ShouldQueue
{

    use Exportable;
    /**
    * PARA GENERAR LA CONSULTA QUE DEVOLVERA LA COLECCIÓN
    */
    public function collection()
    {
        return User::with('roles', 'permissions')->get();
    }

    /* 
    * EL METODO map SIRVE PARA TRABAJAR CON LAS RELACIONES DE ELOQUENT, ES POR ESTO
    * QUE PUEDO ACCEDER A LAS RELACIONES DE LOS MODELOS Y PERMISOS
    */
    public function map($user): array
    {
        return [
            $user->id,
            $user->last_name,
            $user->name,
            $user->email,
            $user->getRoleDisplayNames(),
            $user->getPermissionDisplayNames(),
            $user->created_at->format('d-m-Y'),
        ];
    }

    /* 
    * EL METODO headings PERMITE DEFINIR LAS CABECERAS DE LAS COLUMNAS DEL ARCHIVO
    */
    public function headings(): array
    {
        return [
            '#ID',
            'APELLIDO',
            'NOMBRE',
            'EMAIL',
            'ROLE',
            'PERMISOS ADICIONALES',
            'FECHA DE CREACIÓN',
        ];
    }

    /* 
    * EL METODO styles PERMITE DEFINIR LOS ESTILOS A LAS CABECERAS
    */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
