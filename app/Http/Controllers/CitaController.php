<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CitaController extends Controller
{
    public function crear(Request $request)
    {
                // Valida los datos del formulario
                $request->validate([
                    'event' => 'required|string|max:255',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after_or_equal:start_date',
                ]);
        
                // Crea una nueva instancia de la cita
                $cita = new Event();
                $cita->event = $request->event;
                $cita->description = $request->description;
                $cita->start_date = $request->start_date;
                $cita->end_date = $request->end_date;
                $cita->user_id = auth()->id();
                $cita->color = $request->color;
                
                // Guarda la cita en la base de datos
                $cita->save();
        
                // Redirecciona a una página de éxito o cualquier otra página que desees
                return redirect()->route('calendar_1')->with('success', 'Cita creada exitosamente');
    }

}
