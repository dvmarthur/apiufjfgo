<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $request->input('receiver_id');
        $message->content = $request->input('content');
        $message->save();

        return response()->json($message, 201);
    }


//     // SOBRE O FRONTEND DAS MENSAGENS DO CHAT
//     Configurar o frontend: No seu projeto frontend, 
//     você precisará fazer requisições para as rotas da API fornecidas pelo Laravel para obter
//     as mensagens e enviar novas mensagens.

//     Exibir as mensagens no frontend: No frontend, você pode fazer uma requisição GET
//     para a rota /messages para obter o histórico de mensagens e exibi-las de acordo com
//     a estrutura que você deseja.

//     Enviar novas mensagens: Para enviar novas mensagens, 
//     você pode fazer uma requisição POST para a rota /messages com os dados da nova mensagem,
//     como receiver_id e content. Certifique-se de incluir a autenticação adequada nas requisições 
//     para que apenas usuários autenticados possam enviar mensagens.
}
