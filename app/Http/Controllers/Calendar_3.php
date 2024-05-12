<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_3;

class Calendar_3 extends Controller
{
    public function index()
    {
        // Obtener todos los eventos
        $all_events = Event_3::all();

        // Inicializar un array para almacenar los eventos
        $events = [];

        // Recorrer todos los eventos y construir la lista de eventos con sus propiedades
        foreach ($all_events as $event) {
            // Agregar el evento a la lista con todas sus propiedades, incluido el ID de la tabla 'events'
            $events[] = [
                'id' => $event->id, // Agregar el ID del evento
                'title' => $event->event,
                'description' => $event->description_event,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'creator_id' => $event->user_id, // Obtener el ID del usuario que creó el evento de la tabla 'events'
                'color' => $event->color, // Obtener el ID del usuario que creó el evento de la tabla 'events'
            ];
        }


        // Pasar la lista de eventos a la vista 'dashboard'
        return view('calendar_3', compact('events'));
    }
}
