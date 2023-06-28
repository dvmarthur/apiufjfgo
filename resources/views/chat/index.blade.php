@foreach ($messages as $message)
    <p>{{ $message->content }}</p>
    <small>From: {{ $message->sender_id }}</small>
@endforeach

<!-- FRONT END DAS MENSAGENS ENVIADAS NO BANCO DE DADOS -->