<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function index()
    {
        return view('chat/message');
    }
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        if (trim($message) !== "") {
            // Buat dummy data response misal : "chat masuk"
            $chatMessages = [
                'message' => $message,
                'user' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $chatBotMessages = [
                'message' => 'chat masuk',
                'user' => 'bot',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $result = [$chatMessages, $chatBotMessages];

            return response()->json($chatBotMessages);
        }
    }
}
