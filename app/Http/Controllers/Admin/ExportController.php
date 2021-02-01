<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Jobs\NotifyUserOfCompletedExport;


class ExportController extends Controller
{
    public function exportUserPDF(User $user){  
        $this->authorize('export');

        $pdf = PDF::loadView('admin.exports.pdf.user', ['user' => $user->load(['roles', 'permissions', 'posts', 'comments', 'socialProfiles'])])->setPaper('a4', 'landscape');
        return $pdf->download($user->getFullName() . '.pdf');
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

}
