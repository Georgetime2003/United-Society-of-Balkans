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
    
            $event = Event_4::findOrFail($eventId);
    
            $event->delete();
    
            return redirect()->back()->with('success', 'Evento eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el evento: ' . $e->getMessage());
        }
    }
}
