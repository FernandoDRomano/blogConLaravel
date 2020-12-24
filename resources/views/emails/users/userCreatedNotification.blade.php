@component('mail::message')
# Bienvenido a {{ config('app.name') }}

{{$user->getFullName()}} tus credenciales para ingresar al sistema son:

@component('mail::table')

| Email         | Password      |
| :-------------: |:-------------:|
| {{$user->email}}     | {{$password}}      |

@endcomponent

@component('mail::button', ['url' => url('login')])
Ingresar
@endcomponent

Gracias, <br>
{{ config('app.name') }}
@endcomponent
