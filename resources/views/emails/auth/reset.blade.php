@component('mail::message')
# Introduction

Blood Bank Reset Password.

@component('mail::button', ['url' => 'www.ipda3.com'])
Reset
@endcomponent

<p>Your reset code is {{$code}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
