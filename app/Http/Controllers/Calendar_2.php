<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_2;
<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> parent of e8e271e (Set the all day event to the other calendars)

class Calendar_2 extends Controller
{
    public function index()
    {
        $all_events = Event_2::all();

        // Inicializar un array para almacenar los eventos
        $events = [];

        // Recorrer todos los eventos y construir la lista de eventos con sus propiedades
        foreach ($all_events as $event) {
            // Agregar el evento a la lista con todas sus propiedades, incluido el ID de la tabla 'events'
            $events[] = [
                'id' => $event->id, // Agregar el ID del evento
                'title' => $event->event,
                'description' => $event->description,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'creator_id' => $event->user_id, // Obtener el ID del usuario que creó el evento de la tabla 'events'
                'color' => $event->color, // Obtener el ID del usuario que creó el evento de la tabla 'events'
            ];
        }

        return view('calendar_2', compact('events'));
    }
}
