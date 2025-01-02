<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chatAI(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string'
        ]);

        $message = $validated['message'];

        if (strtolower($message) === 'kamu siapa' || strtolower($message) === 'Hai, siapa Kamu') {
            return response()->json([
                'message' => 'saya adalah generative-N'
            ]);
        } elseif (strtolower($message) === 'terima kasih' || strtolower($message) === 'makasih') {
            return response()->json([
                'message' => 'Okemi kanda ku sama sama'
            ]);
        } elseif (strtolower($message) === 'apa kabar' || strtolower($message) === 'bagaimana kabarmu') {
            return response()->json([
                'message' => 'Alhamdulillah baik, kamu?'
            ]);
        } elseif (strtolower($message) === 'siapa tuhanmu' || strtolower($message) === 'siapa tuhanmu?') {
            return response()->json([
                'message' => 'Tuhan adalah Allah SWT'
            ]);
        }

        $response = $this->callGroq($message);

        return response()->json([
            'message' => $response['choices'][0]['message']['content'] ?? 'No response from AI'
        ]);
    }


    private function callGroq($message)
    {
        $client = new Client();
        $apiKeys = env('GROQ_API_KEY');

        try {
            $response = $client->request('POST', 'https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $apiKeys"
                ],
                'json' => [
                    'messages' => [
                        ['role' => 'user', 'content' => $message]
                    ],
                    'model' => 'llama3-8b-8192',
                    'temperature' => 1,
                    'max_tokens' => 1024,
                    'top_p' => 1,
                    'stream' => false,
                    'stop' => null
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
