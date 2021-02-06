<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(){
        return view('admin.notifications.index', [
            'notifications' => current_user()->notifications()->latest()->paginate(20)
        ]);
    }

    public function show(DatabaseNotification $notification){
        $this->authorize('view-notifications', $notification);

        $notification->markAsRead();
        return view('admin.notifications.show', [
            'notification' => $notification
        ]);
    }

    public function update(DatabaseNotification $notification){
        $this->authorize('update-notifications', $notification);

        $notification->markAsRead();
        return redirect()->route('admin.notifications.index')->with([
            'title' => 'Notificación Actualizada',
            'message' => 'La notificación se ha marcado como leida correctamente',
            'icon' => 'success'
        ]);
    }

    public function readAll(){
        $this->authorize('update-notifications', current_user()->notifications()->first());

        current_user()->unreadNotifications->markAsRead();
        return redirect()->route('admin.notifications.index')->with([
            'title' => 'Notificaciónes Actualizadas',
            'message' => 'Todas las notificaciones fueron marcadas como leídas.',
            'icon' => 'success'
        ]);
    }

    public function destroy(DatabaseNotification $notification){
        $this->authorize('delete-notifications', $notification);

        $notification->delete();
        return redirect()->route('admin.notifications.index')->with([
            'title' => 'Notificación Eliminada',
            'message' => 'La notificación se ha Eliminado correctamente',
            'icon' => 'success'
        ]);
    }

    public function destroyAll(){
        $this->authorize('delete-notifications', current_user()->notifications()->first());

        current_user()->notifications()->delete();

        return redirect()->route('admin.notifications.index')->with([
            'title' => 'Notificaciónes Eliminadas',
            'message' => 'Todas las notificaciones fueron eliminadas correctamente.',
            'icon' => 'success'
        ]);
    }

}
