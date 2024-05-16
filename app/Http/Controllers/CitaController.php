<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CitaController extends Controller
{
    public function crear(Request $request)
    {
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
    
        $cita = new Event();
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
    $event = Event::findOrFail($request->eventId);

    $event->update([
        'event' => $request->eventName,
        'description' => $request->eventDescription,
        'start_date' => $request->eventStartDate,
        'end_date' => $request->eventEndDate,
    ]);
    

    return redirect()->back()->with('success', 'Event updated successfully.');
}



}
