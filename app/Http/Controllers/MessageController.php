<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function getMessages($senderId, $receiverId)
    {
        $messages = Message::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $senderId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $request->route('receiverId');
        $message->content = $request->input('content');
        $message->save();

        return response()->json($message, 201);
    }

    public function getConversations()
{
    $userId = Auth::id();

    $conversations = Message::where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->groupBy('sender_id', 'receiver_id')
        ->get();

    return response()->json($conversations);
}

}
