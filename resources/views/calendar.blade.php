<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="calendar"></div>
                <button id="openCreateEventForm">Crear Nueva Cita</button>

                <dialog id="createEventDialog" class="dialeg">
                    <form action="{{ route('crear-cita') }}" method="POST">
                        @csrf
                        <label for="event">Nombre de la cita:</label>
                        <input type="text" name="event" required><br>
                        <label for="start_date">Fecha y hora de inicio:</label>
                        <input type="datetime-local" name="start_date" required><br>
                        <label for="end_date">Fecha y hora de finalización:</label>
                        <input type="datetime-local" name="end_date" required><br>
                        <button type="submit">Crear Cita</button>
                    </form>
                    <button id="closeCreateEventDialog">Cerrar</button>
                </dialog>
                <dialog id="eventDetailsDialog" class="dialeg">
                    <h2>Detalles de la cita</h2>
                    <p id="eventDetails"></p>
                    <form id="deleteEventForm" action="{{ route('delete-event') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- Input para almacenar el ID del evento -->
                        <input type="hidden" name="eventId" id="eventIdInput" value="">
                        <button type="submit">Eliminar Cita</button>
                    </form>
                    <button id="closeEventDetailsDialog">Cerrar</button>
                </dialog>
                
            </div>
        </div>
    </div>

    @push('styles')
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
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
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
            const creatorId = event.extendedProps.creator_id;
            console.log("ID del creador del evento:", creatorId);

            // Verificar si el evento pertenece al usuario actual
            console.log(currentUser, creatorId);
            if (currentUser == creatorId) {
            const eventDetailsDialog = document.getElementById('eventDetailsDialog');
            const eventDetails = document.getElementById('eventDetails');
            const eventIdInput = document.getElementById('eventIdInput'); // Obtener el input hidden del ID del evento

            eventIdInput.value = event.id; // Asignar el ID del evento al input hidden

            eventDetails.textContent = `Nombre: ${event.title}\nFecha de inicio: ${event.start}\nFecha de fin: ${event.end}`;

            eventDetailsDialog.showModal();
        }
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
                }
            };

            // Agregar el nuevo evento al calendario
            calendar.addEvent(newEvent);

            // Guardar el nuevo evento en la base de datos
            saveEventToDatabase(newEvent); // Esta función deberá enviar el nuevo evento al backend para su almacenamiento en la base de datos
        }
    });
    calendar.render();
    
            const createEventDialog = document.getElementById('createEventDialog');
            const openCreateEventFormButton = document.getElementById('openCreateEventForm');
            const closeCreateEventDialogButton = document.getElementById('closeCreateEventDialog');
            const closeEventDetailsDialogButton = document.getElementById('closeEventDetailsDialog');
    
            openCreateEventFormButton.addEventListener('click', function() {
                createEventDialog.showModal();
            });
    
            closeCreateEventDialogButton.addEventListener('click', function() {
                createEventDialog.close();
            });
    
            closeEventDetailsDialogButton.addEventListener('click', function() {
                eventDetailsDialog.close();
            });

        });
    </script>
    
        
    @endpush
</x-app-layout>
