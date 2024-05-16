<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_4;

class CitaController_4 extends Controller
{
    public function crear(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'event' => 'required|string|max:255',
        ]);
    
        // Agregar las horas automáticamente si es para todo el día
        if ($request->has('allDay')) {
            $start_date = $request->input('date') . ' 00:00:00'; // 
            $end_date = $request->input('date') . ' 23:59:59'; // Añade la hora de fin (antes de medianoche)
        } else {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
        }
    
        // Crea una nueva instancia de la cita
        $cita = new Event_4();
        $cita->event = $request->input('event');
        $cita->description = $request->input('description');
        $cita->start_date = $start_date;
        $cita->end_date = $end_date;
        $cita->user_id = auth()->id();
        $cita->color = $request->input('color');
    
        // Guarda la cita en la base de datos
        $cita->save();
    
        // Redirecciona a una página de éxito o cualquier otra página que desees
        return redirect()->route('calendar_4')->with('success', 'Cita creada exitosamente');
    }
    

    public function update(Request $request) 
    {
            // Agregar esta línea para verificar los datos recibidos
    //dd($request->all());
    $event = Event_4::findOrFail($request->eventId);

    $event->update([
        'event' => $request->eventName,
        'description' => $request->eventDescription,
        'start_date' => $request->eventStartDate,
        'end_date' => $request->eventEndDate,
    ]);
    

    return redirect()->back()->with('success', 'Event updated successfully.');
}



}
