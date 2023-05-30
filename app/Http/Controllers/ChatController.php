<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;

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
            // Buat prompt untuk chatbot
            $prompt = "Kamu merupakan bot yang akan membantu user menjawab kebingungan pada produk yang dijual.";
            $prompt .= "User : $message";
            // Query Product Semua
            $products = Product::all();
            $prompt .= "Product : ";
            foreach ($products as $product) {
                $prompt .= $product->name . ", ";
            }
            $prompt .= "Semua product bersifat testing dan dapat dibeli dengan sistem preoder.";
            $prompt .= "Jika user bertanya diluar konteks, maka bot akan menjawab : Mohon maaf, saya ditujukan untuk menjawab pertanyaan mengenai produk yang dijual.";
            $prompt .=  "User : " . $message;
            // Buat dummy data response misal : "chat masuk"

            $data = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ])
                ->post("https://api.openai.com/v1/chat/completions", [
                    "model" => "gpt-3.5-turbo",
                    'messages' => [
                        [
                            "role" => "user",
                            "content" => $prompt
                        ]
                    ],
                    'temperature' => 0.5,
                    "max_tokens" => 200,
                    "top_p" => 1.0,
                    "frequency_penalty" => 0.52,
                    "presence_penalty" => 0.5,
                    "stop" => ["11."],
                ])
                ->json();

            $response = $data['choices'][0]['message'];

            return response()->json([
                'message' => $response
            ]);
        }
    }
}
