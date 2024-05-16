<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_2;
use App\Models\User;

class Calendar_2 extends Controller
{
    public function index()
    {
        $all_events = Event_2::all();

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

        return view('calendar_2', compact('events'));
    }
}
