<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_3;

class CitaController_3 extends Controller
{
    public function crear(Request $request)
    {
<<<<<<< HEAD
        $request->validate([
            'event' => 'required|string|max:255',
        ]);
    
        if ($request->has('allDay')) {
            $start_date = $request->input('date') . ' 00:00:00'; 
            $end_date = $request->input('date') . ' 23:59:59'; 
        } else {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
        }
    
        $cita = new Event_3();
        $cita->event = $request->input('event');
        $cita->description = $request->input('description');
        $cita->start_date = $start_date;
        $cita->end_date = $end_date;
        $cita->user_id = auth()->id();
        $cita->color = $request->input('color');
    
        $cita->save();
    
        return redirect()->route('calendar_1')->with('success', 'Cita creada exitosamente');
    }
    

    public function update(Request $request) 
    {
    $event = Event_3::findOrFail($request->eventId);

    $event->update([
        'event' => $request->eventName,
        'description' => $request->eventDescription,
        'start_date' => $request->eventStartDate,
        'end_date' => $request->eventEndDate,
    ]);
    

    return redirect()->back()->with('success', 'Event updated successfully.');
}


=======
                // Valida los datos del formulario
                $request->validate([
                    'event' => 'required|string|max:255',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after_or_equal:start_date',
                ]);
        
                // Crea una nueva instancia de la cita
                $cita = new Event_3();
                $cita->event = $request->event;
                $cita->description = $request->description;
                $cita->start_date = $request->start_date;
                $cita->end_date = $request->end_date;
                $cita->user_id = auth()->id();
                $cita->color = $request->color;
                
                // Guarda la cita en la base de datos
                $cita->save();
        
                // Redirecciona a una página de éxito o cualquier otra página que desees
                return redirect()->route('calendar_3')->with('success', 'Cita creada exitosamente');
    }
>>>>>>> parent of e8e271e (Set the all day event to the other calendars)

}
