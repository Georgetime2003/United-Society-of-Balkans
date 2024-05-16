<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_3;
use App\Models\User;
class Calendar_3 extends Controller
{
    public function index()
    {
        // Obtener todos los eventos
        $all_events = Event_3::all();

        $events = [];
        foreach ($all_events as $event) {
            $creator_name = User::find($event->user_id)->name;

            $events[] = [
                'id' => $event->id,
                'title' => $event->event,
                'description' => $event->description,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'creator_id' => $event->user_id, 
                'creator_name' => $creator_name, 
                'color' => $event->color,
            ];
        }


        // Pasar la lista de eventos a la vista 'dashboard'
        return view('calendar_3', compact('events'));
    }
}
