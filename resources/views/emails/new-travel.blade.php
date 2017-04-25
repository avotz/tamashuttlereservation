@component('mail::message')
# Nuevo Viaje (Travel)

Nueva Asignación de vehiculo con reservaciones registrada en el sistema

- Id: {{ $travel->id }} 
- Vehiculo: {{ $travel->vehicles->first()->name }} 
- Reservaciones: {{ $travel->reservations->count() }}

Para ver más información haz click en el siguiente boton:
@component('mail::button', ['url' => 'http://tamashuttle.avotz.com/agenda', 'color' => 'green'])
Agenda
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
