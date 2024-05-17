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
        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
    
        #deleteEventForm {
            margin: 0;
        }
    
        .custom-button {
            background-color: #4CAF50;
            color: white; 
            border: none; 
            padding: 10px 20px; 
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px; 
            margin: 4px 2px;
            cursor: pointer; 
            border-radius: 12px;
        }
    
        .custom-button:hover {
            background-color: #45a049;
        }
    </style>
    
    <script>
document.addEventListener('DOMContentLoaded', function() {
    
    
    const currentUser = "{{ auth()->id() }}"; 
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
            const creatorName = event.extendedProps.creator_name; 
            const isAdmin = "{{ Auth::check() && (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin') }}";

            if (currentUser == creatorId || isAdmin) {
                const eventDetailsDialog = document.getElementById('eventDetailsDialog');
                const eventDetails = document.getElementById('eventDetails');
                const eventIdInput = document.getElementById('eventIdInput');

                eventIdInput.value = event.id;
                eventDetails.innerHTML = `Name: ${event.title}<br>Description: ${description}<br>Start date: ${event.start}<br>Final date: ${event.end}<br>Creator: ${creatorName}`;
                eventDetailsDialog.showModal();
                
                const deleteEventForm = document.getElementById('deleteEventForm');
                deleteEventForm.style.display = "block";

                    document.getElementById('modifyEventButton').addEventListener('click', function() {
                    const eventDetailsDialog = document.getElementById('eventDetailsDialog');
                    const eventModifyDialog = document.getElementById('eventModifyDialog');

                    eventDetailsDialog.close();

                    eventModifyDialog.showModal();

                    document.getElementById('modifyEventId').value = eventIdInput.value;
                    document.getElementById('modifyEventName').value = event.title;
                    document.getElementById('modifyEventDescription').value = description;
                    document.getElementById('modifyEventStartDate').value = event.start;
                    document.getElementById('modifyEventEndDate').value = event.end;
                    document.getElementById('modifyEventColor').value = event.color;

                });
            } else {
                
                const eventDetailsDialog = document.getElementById('eventDetailsDialog');
                const eventDetails = document.getElementById('eventDetails');
                const eventIdInput = document.getElementById('eventIdInput');

                eventIdInput.value = event.id;
                eventDetails.innerHTML = `Name: ${event.title}<br>Description: ${description}<br>Start date: ${event.start}<br>Final date: ${event.end}<br>Creator: ${creatorName}`;
                eventDetailsDialog.showModal();
                
                const deleteEventForm = document.getElementById('deleteEventForm');
                deleteEventForm.style.display = "none";

                const modifyEventButton = document.getElementById('modifyEventButton');
                modifyEventButton.style.display = "none";
            }
        },
        headerToolbar: {
            center: 'dayGridDay,dayGridMonth,timeGridWeek,dayGridYear',
            right: 'prev,today,next'
        },
        select: function(info) {
            const start = info.startStr; 
            const end = info.endStr; 

            const newEvent = {
                title: 'Nuevo evento',
                start: start,
                end: end,
                extendedProps: {
                    creator_id: currentUser 
                },
                color: color,
            };

            calendar.addEvent(newEvent);

            saveEventToDatabase(newEvent); 
        }
    });
    const allDayCheckbox = document.getElementById('allDay');
    const dateTimeInputs = document.getElementById('dateTimeInputs');
    const dateInput = document.getElementById('dateInput');
    
    allDayCheckbox.addEventListener('change', function() {
        if (allDayCheckbox.checked) {
            dateTimeInputs.style.display = 'none';
            dateInput.style.display = 'block'; 
        } else {
            dateTimeInputs.style.display = 'block';
            dateInput.style.display = 'none'; 
        }
    });
    
    allDayCheckbox.dispatchEvent(new Event('change')); 
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
                    <button id="openCreateEventForm" class="custom-button">Create New Event</button>
                    <div id="calendar"></div>
                    <dialog id="createEventDialog" class="dialeg">
                        <form action="{{ route('crear-cita_4') }}" method="POST">
                            @csrf
                            <label for="event">Event Name:</label>
                            <input type="text" name="event" required><br>
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" required></textarea><br>
                            <label for="allDay">All Day:</label>
                            <input type="checkbox" id="allDay" name="allDay"><br>
                            <div id="dateTimeInputs">
                                <label for="start_date">Start Date and Time:</label>
                                <input type="datetime-local" id="start_date" name="start_date"><br>
                                <label for="end_date">End Date and Time:</label>
                                <input type="datetime-local" id="end_date" name="end_date"><br>
                            </div>
                            <div id="dateInput">
                                <label for="date">Date:</label>
                                <input type="date" id="date" name="date"><br>
                            </div>
                            <label for="color">Color:</label>
                            <input type="color" name="color" required><br>
                            <div class="button-container">
                                <button type="submit" class="custom-button">Create Event</button>
                                <button id="closeCreateEventDialog" type="button" class="custom-button">Cancel</button>
                            </div>
                        </form>
                    </dialog>
                    
                    <dialog id="eventDetailsDialog" class="dialeg">
                        <h2>Event Details</h2>
                        <p id="eventDetails"></p>
                        <div class="button-container">
                        <button id="modifyEventButton" class="custom-button">Modify Event</button>
                        
                        <form id="deleteEventForm" action="{{ route('delete-event_4') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="eventId" id="eventIdInput" value="">
                                <button type="submit" class="custom-button">Delete Event</button>
                        </form>
                            <button id="closeEventDetailsDialog" class="custom-button">Close</button>
                        </div>
                    </dialog>
                    <dialog id="eventModifyDialog" class="dialeg">
                        <h2>Modify Event</h2>
                        <form id="modifyEventForm" action="{{ route('update-event_4') }}" method="POST">
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
                            {{-- <label for="eventColor">Color:</label>
                            <input type="color" id="modifyEventColor" name="eventColor" required><br> --}}
                            <div class="button-container">
                                <button type="submit" class="custom-button">Update Event</button>
                            </div>
                            </form>
                            <div class="button-container">
                        <button id="closeModifyEventDialog" class="custom-button">Cancel</button>
                        </div>
                    </dialog>
                </div>
            </div>
        </div>
    </div>
@endsection