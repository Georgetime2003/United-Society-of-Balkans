<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_3;

class DeleteEvent_3 extends Controller
{
    public function destroy(Request $request)
    {
        try {
            $eventId = $request->input('eventId');
    
            // Buscar el evento por su ID
            $event = Event_3::findOrFail($eventId);
    
            // Eliminar el evento de la base de datos
            $event->delete();
    
            return redirect()->back()->with('success', 'Evento eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el evento: ' . $e->getMessage());
        }
    }
}
