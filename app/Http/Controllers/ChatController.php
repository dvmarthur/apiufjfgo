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
        return view('chat.index', compact('messages'));
    }

    public function send(Request $request)
    {
        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $request->input('receiver_id');
        $message->content = $request->input('content');
        $message->save();

        return redirect()->route('chat.index');
    }
}
