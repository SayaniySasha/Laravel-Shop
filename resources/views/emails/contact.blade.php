@component('mail::message')
# Introduction

Hi,

Janus Nic has sent you a message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
