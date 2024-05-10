<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event_3;

class CitaController_3 extends Controller
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
                $cita = new Event_3();
                $cita->event = $request->event;
                $cita->start_date = $request->start_date;
                $cita->end_date = $request->end_date;
                $cita->user_id = auth()->id();
                $cita->color = $request->color;
                
                // Guarda la cita en la base de datos
                $cita->save();
        
                // Redirecciona a una página de éxito o cualquier otra página que desees
                return redirect()->route('calendar_3')->with('success', 'Cita creada exitosamente');
    }

}
