<x-mail::message>
# Your magic login link

<x-mail::button :url="$url">
Log in
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
