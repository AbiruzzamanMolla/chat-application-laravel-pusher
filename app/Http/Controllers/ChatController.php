<?php

namespace App\Http\Controllers;

use App\Events\Message;
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
        event(new Message($request->username, $request->message));
        return ['success' => true];
    }
}
