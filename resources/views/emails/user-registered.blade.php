<h1>Olá {{ $user->name }}, tudo bem? Obrigado por sua inscrição</h1>
<p>
    Faça bom proveito
    Seu e-mail de cadastro é <strong>{{ $user->email }}</strong>
</p>
<p>Email enviado em {{ date('d/m/Y H:i:s') }}</p>