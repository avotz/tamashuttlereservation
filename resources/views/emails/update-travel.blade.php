@component('mail::message')
# Se actualizó Viaje (Travel)

Se actualizó una asignación de vehiculo con reservaciones en el sistema

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
