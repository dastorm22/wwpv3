@component('mail::message')
# An Error Has Occurred:

One or more sources could not be processed on {{ \Carbon\Carbon::now()->toDayDateTimeString() }}.

@foreach($errorMessages as $message)
@component('mail::panel')
{{ $message }}
@endcomponent
@endforeach

Thank you,<br><br>
{{ config('app.name') }}
@endcomponent
