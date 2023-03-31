<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Models\Message as ModelsMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * @param Request $request
     * 
     * @return mixed
     */
    public function sendMessage(Request $request): mixed
    {
        $chat = new ModelsMessage();
        $chat->username = auth()->user()->name;
        $chat->message = $request->message;
        if ($chat->save()) {
            $time = date_format($chat->created_at, "D d M, H:i a");
            event(new Message($chat->username, $chat->message, $time));
            return response()->json([
                'success' => true,
                'message' => 'Message Sent Success.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Message sent failed.'
        ]);
    }
}
