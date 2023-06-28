<form action="{{ route('chat.send') }}" method="post">
    @csrf
    <input type="hidden" name="receiver_id" value="ID_DO_RECEBEDOR">
    <input type="text" name="content" placeholder="Digite sua mensagem">
    <button type="submit">Enviar</button>
</form>

<!-- formulário básico para enviar mensagens. IMPORTANTE: incluir um campo oculto para o receiver_id: -->

<!-- No campo value do campo oculto receiver_id, substitua ID_DO_RECEBEDOR pelo ID do usuário que receberá a mensagem. -->