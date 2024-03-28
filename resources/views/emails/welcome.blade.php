@component('mail::message')
# Introduction

Hello lailis

The body of your message.

Using welcome mail with hardcoded id


@component('mail::button', ['url' => 'http://apps8.kdh.moh.gov.my/emerit/public/sahpenyelia/790914125336'])
Button Text
@endcomponent

{{ $pegawai['nama'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
