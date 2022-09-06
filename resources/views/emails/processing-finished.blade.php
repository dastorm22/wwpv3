@component('mail::message')
# Source Analysis Completed

The manual trigger of source analysis has finished on {{ \Carbon\Carbon::now()->toDayDateTimeString() }}.

@component('mail::button', ['url' => action('AnalysisController@comparison')])
View Analysis
@endcomponent

### Processing Output
@component('mail::panel')
{{ $output }}
@endcomponent

Thank you,<br><br>
{{ config('app.name') }}
@endcomponent
