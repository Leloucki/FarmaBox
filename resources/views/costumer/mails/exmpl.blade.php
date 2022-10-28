@component('mail::message')
Olá **{{$name}}**,  {{-- use double space for line break --}}
Venha para o lado lúcido da força!
Venha conhecer a base filosófica do libertarianismo.
@component('mail::button', ['url' => $link])
Ética argumentativa
@endcomponent
Atenciosamente,
O último heroi da terra B)
@endcomponent