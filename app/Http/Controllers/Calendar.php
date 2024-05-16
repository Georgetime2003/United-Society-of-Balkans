<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class Calendar extends Controller
{
    public function index()
    {
        // Obtener todos los eventos
        $all_events = Event::all();

        // Inicializar un array para almacenar los eventos
        $events = [];

        // Recorrer todos los eventos y construir la lista de eventos con sus propiedades
        foreach ($all_events as $event) {
            // Obtener el nombre del usuario creador del evento por su ID
            $creator_name = User::find($event->user_id)->name;

            // Agregar el evento a la lista con todas sus propiedades, incluido el nombre del creador
            $events[] = [
                'id' => $event->id,
                'title' => $event->event,
                'description' => $event->description,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'creator_id' => $event->user_id, // Obtener el ID del usuario que creó el evento de la tabla 'events'
                'creator_name' => $creator_name, // Agregar el nombre del creador al array de eventos
                'color' => $event->color,
            ];
        }

        // Pasar la lista de eventos a la vista 'calendar_1'
        return view('calendar_1', compact('events'));
    }
}
