<?php

namespace App\Exports;

use App\Post;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PostsExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings, WithStyles, ShouldQueue
{

    use Exportable;
    /**
    * PARA GENERAR LA CONSULTA QUE DEVOLVERA LA COLECCIÓN
    */
    public function query()
    {
        return Post::with('user', 'comments', 'tags', 'category');
    }

    /* 
    * EL METODO map SIRVE PARA TRABAJAR CON LAS RELACIONES DE ELOQUENT, ES POR ESTO
    * QUE PUEDO ACCEDER A LAS RELACIONES DE LOS MODELOS Y PERMISOS
    */
    public function map($post): array
    {
        return [
            $post->id,
            $post->title,
            $post->published_at->format('d-m-Y'),
            $post->user->getFullName(),
            $post->approved ? 'Aprobado' : 'Desaprobado',
            $post->category->name,
            $post->tags->implode('name', ', '),
            $post->comments->count(),
        ];
    }

    /* 
    * EL METODO headings PERMITE DEFINIR LAS CABECERAS DE LAS COLUMNAS DEL ARCHIVO
    */
    public function headings(): array
    {
        return [
            '#ID',
            'TÍTULO',
            'PUBLICADO',
            'AUTOR',
            'ESTADO',
            'CATEGORÍA',
            'ETIQUETAS',
            'COMENTARIOS',
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
