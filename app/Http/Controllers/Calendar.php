<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class Calendar extends Controller
{
    public function index()
    {
        $all_events = Event::all();

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

        return view('calendar_1', compact('events'));
    }
}
