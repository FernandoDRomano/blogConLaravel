@component('mail::message')
# Activación de Cuenta

Hola {{ $user->getFullName() }}. Para poder ingresar a {{ config('app.name')}} debes hacer click en el botón para activar tu cuenta.

@component('mail::button', ['url' => route('users.active', $user->token)])
Activar Cuenta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
