<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\User;
use App\Exports\PostsExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Jobs\NotifyUserOfCompletedExport;
use App\Jobs\NotifyUserOfCompletedExporPostPDF;
use App\Jobs\NotifyUserOfCompletedExportUserPDF;

class ExportController extends Controller
{
    public function exportUserPDF(User $user){  
        $this->authorize('export');

        // DESPACHO UN JOB QUE SE ENCARGARA DE GENERAR EL PDF Y LUEGO NOTIFICAR AL USUARIO QUE SOLICITO EL REPORTE
        NotifyUserOfCompletedExportUserPDF::dispatch($user, current_user());

        return redirect()->back()->with([
            'message' => 'El reporte empezo a generarse, cuando este listo te enviaremos un email y una notificación.', 
            'title' => 'Generando reportes', 
            'icon' => 'success'
        ]);
    }

    public function exportAllUsersExcel(){
        $this->authorize('export');

        $fileName = 'users-' . now(). '.xlsx';
        $filePath = 'storage/' . $fileName;

        (new UsersExport)->store($fileName, 'public')->chain([
            // CUANDO TERMINE DE GENERAR EL ARCHIVO, Y LO ALMACENE EN EL DISCO public, SE EJECUTARA EL SIGUIENTE job
            new NotifyUserOfCompletedExport(current_user(), $filePath),
        ]);

        return redirect()->back()->with([
            'message' => 'El reporte empezo a generarse, cuando este listo te enviaremos un email y una notificación.', 
            'title' => 'Generando Reporte', 
            'icon' => 'success'
        ]);

    }

    public function exportAllPostsExcel(){
        $this->authorize('export');

        $fileName = 'posts-' . now(). '.xlsx';
        $filePath = 'storage/' . $fileName;

        (new PostsExport)->store($fileName, 'public')->chain([
            // CUANDO TERMINE DE GENERAR EL ARCHIVO, Y LO ALMACENE EN EL DISCO public, SE EJECUTARA EL SIGUIENTE job
            new NotifyUserOfCompletedExport(current_user(), $filePath),
        ]);

        return redirect()->back()->with([
            'message' => 'El reporte empezo a generarse, cuando este listo te enviaremos un email y una notificación.', 
            'title' => 'Generando Reporte', 
            'icon' => 'success'
        ]);

    }

}
