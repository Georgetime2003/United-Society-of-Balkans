@extends('layout')
@section('header')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <style>
        .dialeg {
            position: absolute;
            margin: 0;
            padding: 2rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 32.5rem;
            background-color: white;
            border-radius: 1.5rem;
            box-shadow: 8px 8px 24px 0 rgba(0, 0, 0, 0.5);
        }
    </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                
                
                const currentUser = "{{ auth()->id() }}"; // Obtener el ID del usuario actual
                console.log("Usuario actual:", currentUser);
            
                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '10:00',
                    slotMaxTime: '21:00',
                    events: @json($events),
                    eventClick: function(info) {
                        const event = info.event;
                        const description = event.extendedProps.description;
                        const creatorId = event.extendedProps.creator_id;
                        const creatorName = event.extendedProps.creator_name; // Obtener el nombre del creador del evento
                        const isAdmin = "{{ Auth::check() && (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin') }}";
                        // Verificar si el evento pertenece al usuario actual o si es administrador
                        if (currentUser == creatorId || isAdmin) {
                            const eventDetailsDialog = document.getElementById('eventDetailsDialog');
                            const eventDetails = document.getElementById('eventDetails');
                            const eventIdInput = document.getElementById('eventIdInput');
            
                            eventIdInput.value = event.id;
                            eventDetails.innerHTML = `Name: ${event.title}<br>Description: ${description}<br>Start date: ${event.start}<br>Final date: ${event.end}<br>Creator: ${creatorName}`;
                            eventDetailsDialog.showModal();
                            
                            // Mostrar el botón de eliminar solo si es el mismo usuario o es admin
                            const deleteEventForm = document.getElementById('deleteEventForm');
                            deleteEventForm.style.display = "block";
            
                                document.getElementById('modifyEventButton').addEventListener('click', function() {
                                const eventDetailsDialog = document.getElementById('eventDetailsDialog');
                                const eventModifyDialog = document.getElementById('eventModifyDialog');
            
                                // Oculta el diálogo de detalles del evento
                                eventDetailsDialog.close();
                                // Muestra el diálogo de modificación de evento
                                eventModifyDialog.showModal();
                                // Llena el formulario de modificación con los detalles del evento actual
                                document.getElementById('modifyEventId').value = eventIdInput.value;
                                document.getElementById('modifyEventName').value = event.title;
                                document.getElementById('modifyEventDescription').value = description;
                                document.getElementById('modifyEventStartDate').value = event.start;
                                document.getElementById('modifyEventEndDate').value = event.end;
            
            
                            });
                        } else {
                            // Si el usuario no es el creador ni admin, simplemente muestra los detalles sin opción de eliminar
                            const eventDetailsDialog = document.getElementById('eventDetailsDialog');
                            const eventDetails = document.getElementById('eventDetails');
                            const eventIdInput = document.getElementById('eventIdInput');
            
                            eventIdInput.value = event.id;
                            eventDetails.innerHTML = `Name: ${event.title}<br>Description: ${description}<br>Start date: ${event.start}<br>Final date: ${event.end}<br>Creator: ${creatorName}`;
                            eventDetailsDialog.showModal();
                            
                            // Ocultar el botón de eliminar
                            const deleteEventForm = document.getElementById('deleteEventForm');
                            deleteEventForm.style.display = "none";
                        }
                    },
                    headerToolbar: {
                        center: 'dayGridDay,dayGridMonth,timeGridWeek,dayGridYear',
                        right: 'prev,today,next'
                    },
                    select: function(info) {
                        // Cuando se selecciona un rango de tiempo en el calendario
                        const start = info.startStr; // Fecha y hora de inicio del evento
                        const end = info.endStr; // Fecha y hora de fin del evento
            
                        // Crear un nuevo evento con el ID de usuario actual
                        const newEvent = {
                            title: 'Nuevo evento',
                            start: start,
                            end: end,
                            extendedProps: {
                                creator_id: currentUser // Asignar el ID del usuario como creador del evento
                            },
                            color: color,
                        };
            
                        // Agregar el nuevo evento al calendario
                        calendar.addEvent(newEvent);
            
                        // Guardar el nuevo evento en la base de datos
                        saveEventToDatabase(newEvent); // Esta función deberá enviar el nuevo evento al backend para su almacenamiento en la base de datos
                    }
                });
                const allDayCheckbox = document.getElementById('allDay');
                const dateTimeInputs = document.getElementById('dateTimeInputs');
                const dateInput = document.getElementById('dateInput');
                
                allDayCheckbox.addEventListener('change', function() {
                    if (allDayCheckbox.checked) {
                        // Si se activa "Todo el día", ocultar los campos de fecha y hora
                        dateTimeInputs.style.display = 'none';
                        dateInput.style.display = 'block'; // Mostrar el campo de fecha adicional
                    } else {
                        // Si se desactiva "Todo el día", mostrar los campos de fecha y hora
                        dateTimeInputs.style.display = 'block';
                        dateInput.style.display = 'none'; // Ocultar el campo de fecha adicional
                    }
                });
                
                allDayCheckbox.dispatchEvent(new Event('change')); // Ejecutar el evento change al cargar la página para establecer el estado inicial del checkbox
                calendar.render();
            
                        const createEventDialog = document.getElementById('createEventDialog');
                        const openCreateEventFormButton = document.getElementById('openCreateEventForm');
                        const closeCreateEventDialogButton = document.getElementById('closeCreateEventDialog');
                        const closeEventDetailsDialogButton = document.getElementById('closeEventDetailsDialog');
                        const modifyButtonClose = document.getElementById('closeModifyEventDialog');
                        const eventModifyDialog = document.getElementById('eventModifyDialog');
            
                        openCreateEventFormButton.addEventListener('click', function() {
                            createEventDialog.showModal();
                        });
                
                        closeCreateEventDialogButton.addEventListener('click', function() {
                            createEventDialog.close();
                        });
                
                        closeEventDetailsDialogButton.addEventListener('click', function() {
                            eventDetailsDialog.close();
                        });
            
                        modifyButtonClose.addEventListener('click', function() {
                            eventModifyDialog.close();
                        });
                    });
                </script>
@endsection
@section('site_content')
    <div class="background-fixed">
        <div class="container my-2">
            <div class="max-w-7xl mx-auto px-10" >
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <button id="openCreateEventForm">Create New Event</button>
                    <div id="calendar"></div>
                    <dialog id="createEventDialog" class="dialeg">
                        <form action="{{ route('crear-cita_3') }}" method="POST">
                            @csrf
                            <label for="event">Event Name:</label>
                            <input type="text" name="event" required><br>
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" required></textarea><br>
                            <!-- Checkbox para "Todo el día" -->
                            <label for="allDay">All Day:</label>
                            <input type="checkbox" id="allDay" name="allDay"><br>
                            <div id="dateTimeInputs">
                                <!-- Campo de fecha y hora -->
                                <label for="start_date">Start Date and Time:</label>
                                <input type="datetime-local" id="start_date" name="start_date"><br>
                                <label for="end_date">End Date and Time:</label>
                                <input type="datetime-local" id="end_date" name="end_date"><br>
                            </div>
                            <!-- Campo adicional para la fecha si es "Todo el día" -->
                            <div id="dateInput">
                                <label for="date">Date:</label>
                                <input type="date" id="date" name="date"><br>
                            </div>
                            <label for="color">Color:</label>
                            <input type="color" name="color" required><br>
                            <button type="submit">Create Event</button>
                        </form>
                        <button id="closeCreateEventDialog">Cerrar</button>
                    </dialog>
                    
                    
                    

                    <dialog id="eventDetailsDialog" class="dialeg">
                        <h2>Event Details</h2>
                        <p id="eventDetails"></p>
                        <button id="modifyEventButton">Modify Event</button>
                        <form id="deleteEventForm" action="{{ route('delete-event_3') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <!-- Input para almacenar el ID del evento -->
                            <input type="hidden" name="eventId" id="eventIdInput" value="">
                            <button type="submit">Delete Event</button>
                        </form>
                        <button id="closeEventDetailsDialog">Close</button>
                    </dialog>
                    <dialog id="eventModifyDialog" class="dialeg">
                        <h2>Modify Event</h2>
                        <form id="modifyEventForm" action="{{ route('update-event_3') }}" method="POST">
                            @csrf
                            <input type="hidden" name="eventId" id="modifyEventId" value="">
                            <label for="eventName">Event Name:</label>
                            <input type="text" id="modifyEventName" name="eventName" required><br>
                            <label for="eventDescription">Description:</label>
                            <textarea id="modifyEventDescription" name="eventDescription" required></textarea><br>
                            <label for="eventStartDate">Start Time:</label>
                            <input type="datetime-local" id="modifyEventStartDate" name="eventStartDate" required><br>
                            <label for="eventEndDate">End Time:</label>
                            <input type="datetime-local" id="modifyEventEndDate" name="eventEndDate" required><br>
                            <button type="submit">Update Event</button>
                        </form>
                        <button id="closeModifyEventDialog">Cancel</button>
                    </dialog>
                    
                </div>
            </div>
        </div>
    </div>
@endsection