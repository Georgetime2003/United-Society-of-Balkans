<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_4;

class DeleteEvent_4 extends Controller
{
    public function destroy(Request $request)
    {
        try {
            $eventId = $request->input('eventId');
    
            // Buscar el evento por su ID
            $event = Event_4::findOrFail($eventId);
    
            // Eliminar el evento de la base de datos
            $event->delete();
    
            return redirect()->back()->with('success', 'Evento eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el evento: ' . $e->getMessage());
        }
    }
}
